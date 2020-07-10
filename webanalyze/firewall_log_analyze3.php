<?php
/** 33F190D04D71-0B067FFC03A6-1810FA8DBECA
 *
 * Firewall logs analyze (GZS format)
 * 
 * ver.: 3.1
 * date: 15 Apr 2019
 * 
 */
define('VERSION', '3.1');

error_reporting(0);
ini_set('max_execution_time',7200);
set_time_limit ( 7200 );
ini_set('memory_limit', '512M');

$self_delete = 3 * 60 * 60; // 3 hours
$self_file_time = filemtime(__FILE__);
if ( (time() - $self_file_time ) > $self_delete)
{
    unlink(__FILE__);
    die('self delete activated.');
}

$current_dir = dirname(__FILE__);
$website_folder = $current_dir;
if (strpos($website_folder, "/webanalyze") !== false) $website_folder = str_replace("/webanalyze", "", $website_folder);


$action = $_REQUEST['action'];
$filelist = $_REQUEST['filelist'];
$date_from = $_REQUEST['date_from'];
$date_till = $_REQUEST['date_till'];
$ip_addr = trim($_REQUEST['ip_addr']);
$words_and = trim($_REQUEST['words_and']);
$words_or = trim($_REQUEST['words_or']);
$exclude_words_or = trim($_REQUEST['exclude_words_or']);
$view_file = trim($_REQUEST['view_file']);
$view_sources = trim($_REQUEST['view_sources']);
$color_CMS_files = trim($_REQUEST['color_CMS_files']);

if ($action == 'delete_selected_files')
{
    if (count($filelist))
    {
        foreach ($filelist as $file)
        {
            unlink($file);
            echo $file. " - removed"."</br>";
        }
    }
}

if ($action == 'tool_filetime')
{
    $tool_filetime = trim($_REQUEST['tool_filetime']);
    echo $tool_filetime.' (Time: '.date ("Y-m-d H:i:s", filemtime($tool_filetime)).')';
    echo "<hr>";
}

if ($view_sources != '') die(ViewFileSources($view_sources));


$show_blocked_ip = intval($_REQUEST['show_blocked_ip']);
$show_selected_files_ip = intval($_REQUEST['show_selected_files_ip']);
$show_list_detected_files_list = intval($_REQUEST['show_list_detected_files_list']);

if ($action == 'kill') 
{
    unlink(__FILE__);
    die('File '.__FILE__.' removed.');
}

$firewall_logs_folder = '';
if (file_exists($current_dir."/webanalyze/firewall/firewall.php")) $firewall_logs_folder = $current_dir."/webanalyze/firewall/logs/";
if (file_exists($current_dir."/firewall/firewall.php")) $firewall_logs_folder = $current_dir."/firewall/logs/";

if ($firewall_logs_folder == '') echo '<p class="err">Firewall module is absent</p>';



// Collect the list of log files
$file_list = array();
//if (file_exists($firewall_logs_folder."_blocked.log.gz")) $file_list[$firewall_logs_folder."_blocked.log"] = '_blocked.log.gz_000.php';
foreach (glob($firewall_logs_folder."*.log.gzs") as $filename) 
{
    $file_short = basename($filename);
    $file_list[$filename] = $file_short;
}


if ($action == 'remove_all_logs') 
{
    if (count($file_list))
    {
        foreach ($file_list as $file => $fileshort)
        {
            unlink($file);
            echo $file. " - removed"."</br>";
        }
        unlink($firewall_logs_folder.'_blocked.log.gz');
        exit;     
    }
}



// Check for auto_prepend_file value
$php_auto_prepend_file = trim(ini_get('auto_prepend_file'));
if ($php_auto_prepend_file == '') echo '<p class="alertrow red">auto_prepend_file is not valid. use php.ini, .user.ini or .htaccess methods (read FAQ)</p>';
else {
	if (strpos($php_auto_prepend_file , "firewall.php") !== false) echo '<p class="alertrow green">auto_prepend_file = '.$php_auto_prepend_file.' - OK</p>';
	else echo '<p class="alertrow red">auto_prepend_file = '.$php_auto_prepend_file.' [not our firewall module]</p>';
}

$results = array();
if ($action == 'startsearch')
{
    // Filter preparation
    if ($date_from == '') $date_from = date("Y-m-d", mktime(0, 0, 0, date("m")-1, date("d"), date("Y")));
    if ($date_till == '') $date_till = date("Y-m-d");
    
    if ($ip_addr != '')
    {
        $ip_addr_arr = explode("\n", $ip_addr);
        foreach ($ip_addr_arr as $k => $v)
        {
            $ip_addr_arr[$k] = trim($v);
        }
    }
    
    if ($words_and != '')
    {
        $words_and_arr = explode("\n", $words_and);
        foreach ($words_and_arr as $k => $v)
        {
            $words_and_arr[$k] = trim($v);
        }
    }
    
    if ($words_or != '')
    {
        $words_or_arr = explode("\n", $words_or);
        foreach ($words_or_arr as $k => $v)
        {
            $words_or_arr[$k] = trim($v);
        }
    }
    
    if ($exclude_words_or != '')
    {
        $exclude_words_or_arr = explode("\n", $exclude_words_or);
        foreach ($exclude_words_or_arr as $k => $v)
        {
            $exclude_words_or_arr[$k] = trim($v);
        }
    }



    $show_blocked_ip_arr = array();
    if ($show_blocked_ip)
    {
        $file = $firewall_logs_folder.'_blocked.log.gzs';
		
		$contents = Read_Decode_GZS_file($file);
        $contents = explode("\n", $contents);


        if (count($contents))
        {
            foreach ($contents as $row)
            {
                if ($row[0] == '2')
                {
                    $tmp_s = explode(",", $row);
                    $tmp_ip = trim(str_replace("Blocked ", "", $tmp_s[1]));
                    $show_blocked_ip_arr[$tmp_ip] = $tmp_ip;
                }
            }
            
            sort($show_blocked_ip_arr);
        }
    }
    
    
    $show_selected_files_ip_arr = array();
    $show_list_detected_files_list_array = array();
    
    if ($view_file != '') $filelist = array($view_file);
    if (count($filelist))
    {
        foreach ($filelist as $file)
        {
            $contents = Read_Decode_GZS_file($file);
	
            $contents = explode("\n"."-=^=-"."\n", $contents);
            
			if (stripos($file, '_blocked.log.gzs') === false) 
			{
				unset($contents[0]);
			}
            
            //print_r($contents);
			
			
            if (count($contents))
            {
				$real_k = 0;
                foreach ($contents as $k => $row)
                {
                    $row = trim($row);
                    if ($row[0] != '2' && $k > 1) 
					{
						$contents[$real_k] = $contents[$real_k]."\n".$row;
						unset($contents[$k]);
					}
					else $real_k = $k;
				}
				
                foreach ($contents as $k => $row)
                {
                    $row = trim($row);
                    if ($row[0] != '2') continue;
                    
                    
                    if ($view_file != '') 
                    {
                        $results[] = $row; 
                        if ($show_list_detected_files_list == 1) 
                        {
                            $real_file_path = GetRealFilePath($file);
                            $real_file_path_short = str_replace($website_folder, "", $real_file_path);
                            $show_list_detected_files_list_array[$real_file_path_short] = $real_file_path_short;
                        }
                        continue;
                    }
                    
                    if ($date_from != '' && $date_till != '')
                    {
                        $row_date = substr($row, 0, 10);
                        //echo $row_date." ";
                        if ($row_date >= $date_from && $row_date <= $date_till) 
                        {
                            if ($ip_addr == '' && $words_and == '' && $words_or == '' && $exclude_words_or == '')
                            {
                                $results[] = $row; 
                                if ($show_selected_files_ip)
                                {
                                    $tmp_ip = GetIPfromRow($row);
                                    $show_selected_files_ip_arr[$tmp_ip] += 1;
                                }
                                
                                if ($show_list_detected_files_list == 1) 
                                {
                                    $real_file_path = GetRealFilePath($file);
                                    $real_file_path_short = str_replace($website_folder, "", $real_file_path);
                                    $show_list_detected_files_list_array[$real_file_path_short] = $real_file_path_short;
                                }
                                continue;     // Next row
                            }
                        }
                        else continue;
                        
                        
                        $flag_add_row_to_results = false;
                        
                        
                        if ($exclude_words_or != '')
                        {
                            $tmp_flag = false;
                            foreach ($exclude_words_or_arr as $tmp_s)
                            {
                                $tmp_s = trim($tmp_s);
                                if (stripos($row, $tmp_s) !== false)
                                {
                                    $tmp_flag = true;
                                    break; 
                                }
                            }
                            
                            if ($tmp_flag === true) continue;  // Next row
                        }
                        
                        
                        if ($ip_addr != '')
                        {
                            $tmp_flag = false;
                            foreach ($ip_addr_arr as $tmp_s)
                            {
                                $tmp_s = trim($tmp_s);
                                if (stripos($row, "IP:".$tmp_s) !== false)
                                {
                                    $tmp_flag = true;
                                    break; 
                                }
                            }
                            
                            if ($tmp_flag === false) continue;  // Next row
                            
                        }


                        if ($words_and != '')
                        {
                            $tmp_flag = false;
                            foreach ($words_and_arr as $tmp_s)
                            {
                                $tmp_s = trim($tmp_s);
                                if (stripos($row, $tmp_s) === false)
                                {
                                    $tmp_flag = true;
                                    break; 
                                }
                            }
                            
                            if ($tmp_flag === true) continue;  // Next row
                        }
                        
                        
                        if ($words_or != '')
                        {
                            $tmp_flag = false;
                            foreach ($words_or_arr as $tmp_s)
                            {
                                $tmp_s = trim($tmp_s);
                                if (stripos($row, $tmp_s) !== false)
                                {
                                    $tmp_flag = true;
                                    break; 
                                }
                            }
                            
                            if ($tmp_flag === false) continue;  // Next row
                        }
                        
                        $results[] = $row;
                        
                        if ($show_list_detected_files_list == 1) 
                        {
                            $real_file_path = GetRealFilePath($file);
                            $real_file_path_short = str_replace($website_folder, "", $real_file_path);
                            $show_list_detected_files_list_array[$real_file_path_short] = $real_file_path_short;
                        }
                        
                        if ($show_selected_files_ip)
                        {
                            $tmp_ip = GetIPfromRow($row);
                            $show_selected_files_ip_arr[$tmp_ip] += 1;
                        }
                    }
                }
            }
        }
    }
}



?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Firewall log analyse ver. <?php echo VERSION;?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://www.siteguarding.com/_office/pure-min.css">
<link href="https://www.siteguarding.com/_office/style.css?ver=7" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body >
<style>
.min_textarea_h{height: 105px;}
.pure-menu-item a label{margin:0}
.font50{font-size:50%}
.alertrow{font-size:60%;padding:2px 5px;margin:0;}
.message_body{width:auto}
.singleview{position:absolute;top:10px;right:10px;font-size:70%;}
</style>
<script>
$( function() {
    $( "#date_from, #date_till" ).datepicker({
      dateFormat: "yy-mm-dd",
      changeMonth: true,
      changeYear: true
    });
} );
function CleanFld(id)
{
    $('#'+id).val('');
}
function StartSearch()
{
    $('#SearchForm').submit();
}
function SelectFileList()
{
    $(".fl").prop( "checked", true );
}
function UnSelectFileList()
{
    $(".unfl").prop( "checked", false );
}
function DeleteAllFiles()
{
    if (confirm("Delete all the files?") == true) {
        window.location.href = 'firewall_log_analyze3.php?action=remove_all_logs';
    } else {
        /* Canceled */
    }
}
function DeleteSelectedFiles()
{
    if (confirm("Delete selected files?") == true) {
        $('#action').val('delete_selected_files');
        $('#SearchForm').submit();
    } else {
        /* Canceled */
    }
}
function ViewSingleFile(file)
{
    $('#view_file').val(file);
    $('#SearchForm').submit();
}
function StartTools(action)
{
    $('#action').val(action);
    $('#SearchForm').submit();
}
function OpenTools()
{
    $('#Tools').toggle();
}
function AddText(id, txt_value)
{
    var txt = $("#"+id).val();
    if (txt != '') txt = txt + "\n" + txt_value;
    else txt = txt_value;
    $("#"+id).val(txt);
}
</script>

        
        

        
<form class="pure-form pure-form-stacked" id="SearchForm" method="post">
    
    <input name="action" id="action" type="hidden" value="startsearch">
    <input name="view_file" id="view_file" type="hidden" value="">
    
<div class="pure-g">
<div class="pure-u-1-5">
<h2 class="headpadding">Files <span class="font50">[<a href="javascript:;" onclick="SelectFileList()">check all</a>]&nbsp;[<a href="javascript:;" onclick="UnSelectFileList()">uncheck all</a>]</span></h2>
<div class="ver_sep_line_r">

    <div class="vert_menu" id="Message_Inbox">
        <div id="List_inner">
			<ul class="pure-menu-list">
            <?php
            if (count($file_list))
            {
                foreach ($file_list as $long_file => $short_file) 
                {
                    if ($short_file != '_blocked.log.gzs') $short_file = substr($short_file, 0, strrpos($short_file, "_"));
                    if (in_array($long_file, $filelist)) $checked = 'checked="checked"';
                    else $checked = '';
                    
                    $real_file_path_short = "";
                    $css_color_CMS_files = "";
                    if ($short_file != '_blocked.log.gzs' && $short_file != 'firewall_log_analyze3.php') 
                    {
                        $class_FL = 'fl';
                        
                        // Get real file path
                        $real_file_path = GetRealFilePath($long_file);
                        $real_file_path_short = str_replace($website_folder, "", $real_file_path);
                        
                        if ($color_CMS_files == 'joomla')
                        {
                            switch ($real_file_path_short)
                            {
                                case '/index.php':
                                case '/administrator/index.php':
                                    $css_color_CMS_files = "green";
                                    break;
                            }
                        }
                        if ($color_CMS_files == 'wordpress')
                        {
                            switch ($real_file_path_short)
                            {
                                case '/index.php':
                                case '/wp-signup.php':
                                case '/wp-login.php':
                                case '/xmlrpc.php':
								case '/wp-comments-post.php':
								case '/wp-cron.php':
                                
                                case '/wp-admin/admin.php':
                                case '/wp-admin/edit-comments.php':
                                case '/wp-admin/ms-admin.php':
                                case '/wp-admin/link.php':
                                case '/wp-admin/menu-header.php':
                                case '/wp-admin/ms-upgrade-network.php':
                                case '/wp-admin/upgrade-functions.php':
                                case '/wp-admin/options-reading.php':
                                case '/wp-admin/my-sites.php':
                                case '/wp-admin/nav-menus.php':
                                case '/wp-admin/edit-tags.php':
                                case '/wp-admin/admin-ajax.php':
                                case '/wp-admin/comment.php':
                                case '/wp-admin/plugin-install.php':
                                case '/wp-admin/revision.php':
                                case '/wp-admin/options-general.php':
                                case '/wp-admin/edit-link-form.php':
                                case '/wp-admin/ms-users.php':
                                case '/wp-admin/options-permalink.php':
                                case '/wp-admin/link-add.php':
                                case '/wp-admin/user-new.php':
                                case '/wp-admin/ms-sites.php':
                                case '/wp-admin/users.php':
                                case '/wp-admin/edit-form-comment.php':
                                case '/wp-admin/plugins.php':
                                case '/wp-admin/media-new.php':
                                case '/wp-admin/admin-post.php':
                                case '/wp-admin/options-media.php':
                                case '/wp-admin/options.php':
                                case '/wp-admin/link-manager.php':
                                case '/wp-admin/options-writing.php':
                                case '/wp-admin/media.php':
                                case '/wp-admin/export.php':
                                case '/wp-admin/admin-footer.php':
                                case '/wp-admin/admin-functions.php':
                                case '/wp-admin/post-new.php':
                                case '/wp-admin/menu.php':
                                case '/wp-admin/edit.php':
                                case '/wp-admin/ms-edit.php':
                                case '/wp-admin/load-scripts.php':
                                case '/wp-admin/options-discussion.php':
                                case '/wp-admin/freedoms.php':
                                case '/wp-admin/upload.php':
                                case '/wp-admin/options-head.php':
                                case '/wp-admin/about.php':
                                case '/wp-admin/upgrade.php':
                                case '/wp-admin/async-upload.php':
                                case '/wp-admin/moderation.php':
                                case '/wp-admin/index.php':
                                case '/wp-admin/custom-background.php':
                                case '/wp-admin/network.php':
                                case '/wp-admin/widgets.php':
                                case '/wp-admin/ms-options.php':
                                case '/wp-admin/media-upload.php':
                                case '/wp-admin/install-helper.php':
                                case '/wp-admin/admin-header.php':
                                case '/wp-admin/ms-themes.php':
                                case '/wp-admin/credits.php':
                                case '/wp-admin/install.php':
                                case '/wp-admin/setup-config.php':
                                case '/wp-admin/themes.php':
                                case '/wp-admin/import.php':
                                case '/wp-admin/link-parse-opml.php':
                                case '/wp-admin/edit-form-advanced.php':
                                case '/wp-admin/user-edit.php':
                                case '/wp-admin/tools.php':
                                case '/wp-admin/profile.php':
                                case '/wp-admin/custom-header.php':
                                case '/wp-admin/post.php':
                                case '/wp-admin/plugin-editor.php':
                                case '/wp-admin/load-styles.php':
                                case '/wp-admin/customize.php':
                                case '/wp-admin/ms-delete-site.php':
                                case '/wp-admin/term.php':
                                case '/wp-admin/theme-install.php':
                                case '/wp-admin/edit-tag-form.php':
                                case '/wp-admin/theme-editor.php':
                                case '/wp-admin/update-core.php':
                                case '/wp-admin/press-this.php':
                                case '/wp-admin/update.php':

                                    $css_color_CMS_files = "green";
                                    break;
                            }
                        }
                    }
                    else $class_FL = '';
                    

                ?>
                <li class="pure-menu-item">
                    <a title="<?php echo $real_file_path_short; ?>" href="javascript:;" class="pure-menu-link textlimiter <?php echo $css_color_CMS_files; ?>">
                        <label><input class="<?php echo $class_FL; ?> unfl" name="filelist[]" value="<?php echo $long_file; ?>" <?php echo $checked; ?> type="checkbox" /> <?php echo $short_file; ?></label>
                    </a>
                    <a class="singleview" href="javascript:;" onclick="ViewSingleFile('<?php echo $long_file; ?>');"><i class="Defaults-binocle"></i></a></li>
                <?php
                }
            }
            ?>
			</ul>
            <?php
            if (count($file_list)) {
            ?>
            <p style="text-align: center;">
                <button type="button" onclick="DeleteSelectedFiles();" class="pure-button">Remove selected</button>
                <a type="button" onclick="DeleteAllFiles();" class="pure-button">Remove all</a>
            </p>
            <?php
            }
            ?>
		</div>
    </div>

</div>  
</div>

<div class="pure-u-4-5">

	<h2 class="headpadding">Filters <button type="button" onclick="StartSearch();" class="pure-button font50">Apply</button>  <span style="font-size:50%">all filters with AND logic  </span><a class="font70" href="javascript:;" onclick="OpenTools();"><i class="Defaults-kolba"></i></a><a style="float: right;font-size:50%" href="firewall_log_analyze3.php?action=kill">Self Remove</a><span style="padding-right:10px;float: right;font-size:50%">auto remove in <?php echo round(($self_file_time + $self_delete - time())/60); ?> mins</span></h2>
    <div class="message_body">
    
    <div class="pure-g" id="Tools" style="display: none;">
        <div class="pure-u-1">
            <h3>Extra tools</h3>
            <div class="pure-u-1 space_b_small">
                <?php if ($tool_filetime == '') $tool_filetime = $current_dir."/"; ?>
               <span style="float: left;">File</span><input style="margin-left:10px;float: left;width: 80%;" id="tool_filetime" name="tool_filetime" type="text" value="<?php echo $tool_filetime; ?>" style="margin-top: 4px;">
               <button style="margin-left:10px;float: left;" type="button" onclick="StartTools('tool_filetime');" class="pure-button">Time Stamp</button>
            </div>
        </div>
        <div class="pure-u-1">
            <div class="pure-u-1-8">Color CMS files:</div>
            <div class="pure-u-1-4">
                <select name="color_CMS_files" id="color_CMS_files" class="pure-input-1">
                <option value="">Don't color</option>
                <option <?php if ($color_CMS_files == 'wordpress') echo 'selected'; ?> value="wordpress">WordPress</option>
                <option <?php if ($color_CMS_files == 'joomla') echo 'selected'; ?> value="joomla">Joomla</option>
                </select>
            </div>
        </div>  
        <hr class="pure-u-1" /> 
    </div>
	
    <div class="pure-g">
        <div class="pure-u-1-8">
            Date from
            <div class="pure-u-7-8 space_b_small">
                <input id="date_from" name="date_from" type="text" value="<?php echo $date_from; ?>" class="pure-input-1" style="margin-top: 4px;">
            </div>
            <div class="pure-u-7-8 space_b_small">
                 till <input id="date_till" name="date_till" type="text" value="<?php echo $date_till; ?>" class="pure-input-1">
            </div>  
        </div>   
        
        <div class="pure-u-1-5">
            IP addresses (OR) <a href="javascript:;" onclick="CleanFld('ip_addr');"><i class="Defaults-trash"></i></a>
            <div class="pure-u-7-8 space_b_small">
                <textarea id="ip_addr" name="ip_addr" class="pure-input-1 min_textarea_h font70" placeholder="one IP per line"><?php echo $ip_addr; ?></textarea>
            </div>

        </div> 
        
        <div class="pure-u-1-5">
            Search Words (AND) <a href="javascript:;" onclick="CleanFld('words_and');"><i class="Defaults-trash"></i></a>
            <div class="pure-u-7-8 space_b_small">
                <textarea id="words_and" name="words_and" class="pure-input-1 min_textarea_h font70" placeholder="one word per line"><?php echo $words_and; ?></textarea>
            </div>
        </div> 
        
        <div class="pure-u-1-5">
            Search Words (OR) <a href="javascript:;" onclick="CleanFld('words_or');"><i class="Defaults-trash"></i></a>
            <div class="pure-u-7-8 space_b_small">
                <textarea id="words_or" name="words_or" class="pure-input-1 min_textarea_h font70" placeholder="one word per line"><?php echo $words_or; ?></textarea>
            </div>
        </div>  
        
        <div class="pure-u-1-5">
            Exclude Words (OR) <a href="javascript:;" onclick="CleanFld('exclude_words_or');"><i class="Defaults-trash"></i></a>
            <div class="pure-u-7-8 space_b_small">
                <textarea id="exclude_words_or" name="exclude_words_or" class="pure-input-1 min_textarea_h font70" placeholder="one word per line"><?php echo $exclude_words_or; ?></textarea>
            </div>
        </div> 
    </div> 
    

    <div class="pure-g">
        <div class="pure-u-1-4">
            <label><input name="show_blocked_ip" value="1" <?php if ($show_blocked_ip) echo 'checked="checked"'; ?> type="checkbox" /> Show IPs from _blocked.log.gzs</label>
        </div>
        <div class="pure-u-1-4">
            <label><input name="show_selected_files_ip" value="1" <?php if ($show_selected_files_ip) echo 'checked="checked"'; ?> type="checkbox" /> Show IPs from select files</label>
        </div>
        <div class="pure-u-1-4">
            <label><input name="show_list_detected_files_list" value="1" <?php if ($show_list_detected_files_list) echo 'checked="checked"'; ?> type="checkbox" /> Show list of detected files</label>
        </div>
    </div>
    
    <i class="Defaults-help green"></i><a href="javascript:$('#help_block').show();">Show Help</a>
    <div class="ui error message" id="help_block" style="display: none;">
        <a href="javascript:;" onclick="AddText('words_and', 'UPLOADED FILES:');">UPLOADED FILES:</a> - find all upload actions ($_FILE)<br />
        <a href="javascript:;" onclick="AddText('words_and', '[log]');">[log]</a> - find all WordPress login actions<br />
        <a href="javascript:;" onclick="AddText('words_and', '[username]');">[username]</a> - find all Joomla/Magento login actions<br />
		<a href="javascript:;" onclick="AddText('words_and', '[wordpress_logged_in_');">[wordpress_logged_in_</a> - logged session to WordPress<br />
    </div>
    
    
    <?php
    if (count($show_blocked_ip_arr))
    {
        ?>
        <h3>IP addresses from _blocked.log.gzs</h3>
        <?php
        foreach ($show_blocked_ip_arr as $row)
        {
            echo $row."</br>";
        }
    }
    ?>
    
    <?php
    if (count($show_selected_files_ip_arr))
    {
        asort($show_selected_files_ip_arr);
        ?>
        <h3>IP addresses from selected files</h3>
        <?php
        foreach ($show_selected_files_ip_arr as $row_ip => $row_hits)
        {
            echo $row_ip.' - '.$row_hits.' hits'."</br>";
        }
    }
    ?>
    
    <?php
    if (count($show_list_detected_files_list_array))
    {
        sort($show_list_detected_files_list_array);
        ?>
        <h3>Results detected in</h3>
        <?php
        foreach ($show_list_detected_files_list_array as $row)
        {
            echo $row."</br>";
        }
    }
    ?>
    
    
    <?php
    if ($view_file != '') 
    {
        echo '<p class="font70 red">File view. Filters are not active.</p>';
        echo '<p class="font70">Log File: <a href="firewall_log_analyze3.php?view_sources='.$view_file.'" target="_blank">'.$view_file.'</a></p>';
        if (stripos($file, '_blocked.log.gzs') === false) 
        {
            $real_file_path = GetRealFilePath($view_file);
            $real_file_path_short = str_replace($website_folder, "", $real_file_path);
            echo '<p class="font70">Real File: <a href="firewall_log_analyze3.php?view_sources='.$view_file.'" target="_blank">'.$real_file_path_short.'</a></p>';
        }
    }
    ?>
    <h2>Results</h2>
    <?php 
        if (count($results)) 
        {
            foreach ($results as $row)
            {
                echo "<pre>".htmlentities($row)."</pre>";
                echo "<hr>";
            }
        } 
    ?>
	


        
    </div>
</div>


    
</div>
</form>




</body>
</html>



<?php

function GetRealFilePath($file)
{
    $handle = gzopen($file, "r");
    $contents = gzread($handle, 1024);
    gzclose($handle);
    
    $rows = explode("\n", $contents);
    return $rows[1];
}

function GetIPfromRow($row)
{
    $row_tmp = explode("\n", $row);
    return trim(str_replace("IP:", "", $row_tmp[1]));
}

function ViewFileSources($log_file)
{
    $handle = fopen($log_file, "r");
    $contents = fread($handle, 1000);
    fclose($handle);
    
    $a = explode("\n\n"."-=^=-"."\n\n", $contents);
    $a = explode("\n", $a[0]);
    
	$file = trim(str_replace("File:", "", $a[1]));
    
    if (!file_exists($file)) return "<b>File ".$file." is absent</b> ".$file;
    
    if ($file != '')
    {
        $handle = fopen($file, "r");
        $contents = fread($handle, filesize($file));
        fclose($handle);
    }
    
    return "File: ".$file." [size: ".filesize($file)." bytes]</br></br>".highlight_string($contents, true)."";
}

function Text_DecodeZip($encoded_txt)
{
    return gzinflate($encoded_txt);
}

function Read_Decode_GZS_file($file)
{
    $handle = fopen($file, "r");
    $contents = fread($handle, filesize($file));
    fclose($handle);
    
    $a = explode("\n\n"."-=^=-"."\n\n", $contents);
    
    foreach ($a as $k => $v)
    {
        if (stripos($v, '<?php') !== false) continue;
        
        $a[$k] = Text_DecodeZip($v);
    }

    $contents = implode("\n\n"."-=^=-"."\n\n", $a);
    
    return $contents;
}

/*
function gzfilesize($FileRead) 
{ 
		$FileOpen = fopen($FileRead, "rb");
        fseek($FileOpen, -4, SEEK_END);
        $buf = fread($FileOpen, 4);
        $GZFileSize = end(unpack("V", $buf));
        fclose($FileOpen);

		return $GZFileSize;
}
*/

?>
        