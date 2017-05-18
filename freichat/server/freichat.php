<?php

/*
 * 
 * FreiChat Notification System 
 * 
 * ** data is stored in JSON format 
 * 
 * EVENTS
 * 
 * 1=> User is added
 *      data -> {username , avatar(opt), (opt) ....}
 *      actor -> (userid)
 *      target -> (all online users/guests/friends)
 * 
 * 2=> User is removed
 *      actor -> (nothing because done by someone else not important)
 *      target -> (same as UADD)
 * 
 * 3=> A messaged from actor -> target
 *      actor -> from id
 *      target -> to id
 *      data -> message content {content}
 * 
 * 4=> Status changed
 *      actor changed status to data(contains the status) {(int)status}
 * 
 * 5=> User changes a chatroom
 *      actor -> his id
 *      target -> same as UADD
 *      data -> id of the new room {id}
 * 
 * 
 * NOTE: chatroom users are not fetched but are filtered off from online users
 */



session_start();
error_reporting(-1);

if (get_magic_quotes_gpc()) {
    $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
    while (list($key, $val) = each($process)) {
        foreach ($val as $k => $v) {
            unset($process[$key][$k]);
            if (is_array($v)) {
                $process[$key][stripslashes($k)] = $v;
                $process[] = &$process[$key][stripslashes($k)];
            } else {
                $process[$key][stripslashes($k)] = stripslashes($v);
            }
        }
    }
    unset($process);
}


require '../arg.php';

if ($_REQUEST['freimode'] == 'post' || $_REQUEST['freimode'] == 'video' || $_REQUEST['freimode'] == 'create_video_session' || $_REQUEST['freimode'] == 'update_status') {
    $id = $_POST['id'];
    if (isset($_SESSION[$uid . "is_xc"]) && $_SESSION[$uid . "is_xc"] == true) {
        $_POST['xhash'] = md5($id . $uid);
    }
    $xhash = $_POST['xhash'];
} else {
    $id = $_GET['id'];
    if (isset($_SESSION[$uid . "is_xc"]) && $_SESSION[$uid . "is_xc"] == true) {
        $_GET['xhash'] = md5($id . $uid);
    }
    $xhash = $_GET['xhash'];
}



if (md5($id . $uid) != $xhash) {
    $_SESSION[$uid . 'usr_ses_id'] = 0;
    echo 'invalid install uid';
    $_GET['id'] = 0;
    $_GET['first'] = 'false';
    exit;
}

//*******************************//OOP ROCKS !//***********************************//
class freichat_data {
    
}

class freichatX extends FreiChat {

    public $userdata;
    public $messages = array();
    public $chatroom_raw_mesgs = array();
    public $isset_video_offer = false;
    public $is_mobile;

    public function __construct() {
        parent::__construct();
        $this->init_vars();
        require_once RDIR . '/server/drivers/' . $this->driver . '.php';
        $this->url = str_replace('server/freichat.php', '', $this->url);
        $this->frm_id = $_SESSION[$this->uid . 'usr_ses_id'];
        $this->frm_name = $_SESSION[$this->uid . 'usr_name'];
        //$this->connectDB();


        if (isset($_GET['mobile'])) {
            $this->is_mobile = (int) $_GET['mobile'];
        } else {
            $this->is_mobile = 0;
        }

        if ($this->is_mobile == 1) {
            $this->show_videochat_plugin = 'disabled';
        }

        if ($this->debug == true) {

            error_reporting(-1);
        }
    }

//-------------------------------------------------------------------------
    public function bigintval($value) {
        $value = trim($value);
        if (ctype_digit($value)) {
            return $value;
        }
        $value = preg_replace("/[^0-9](.*)$/", '', $value);
        if (ctype_digit($value)) {
            return $value;
        }
        return 0;
    }

//-----------------------------------------------------------------------------
    function str_pad_html($strInput = "", $intPadLength, $strPadString = "&nbsp;", $intPadType = STR_PAD_RIGHT) {
        if (strlen(trim(strip_tags($strInput))) < intval($intPadLength)) {

            switch ($intPadType) {
                // STR_PAD_LEFT
                case 0:
                    $offsetLeft = intval($intPadLength - strlen(trim(strip_tags($strInput))));
                    $offsetRight = 0;
                    break;

                // STR_PAD_RIGHT
                case 1:
                    $offsetLeft = 0;
                    $offsetRight = intval($intPadLength - strlen(trim(strip_tags($strInput))));
                    break;

                // STR_PAD_BOTH
                case 2:
                    $offsetLeft = intval(($intPadLength - strlen(trim(strip_tags($strInput)))) / 2);
                    $offsetRight = round(($intPadLength - strlen(trim(strip_tags($strInput)))) / 2, 0);
                    break;

                // STR_PAD_RIGHT
                default:
                    $offsetLeft = 0;
                    $offsetRight = intval($intPadLength - strlen(trim(strip_tags($strInput))));
                    break;
            }

            $strPadded = str_repeat($strPadString, $offsetLeft) . $strInput . str_repeat($strPadString, $offsetRight);
            unset($strInput, $offsetLeft, $offsetRight);

            return $strPadded;
        } else {
            return $strInput;
        }
    }

//----------------------------------------------------------------------------
    public function makeClickableLinks($text) {
        $text = preg_replace('#(script|about|applet|activex|chrome):#is', "\\1:", $text);
        $ret = ' ' . $text;
        $ret = preg_replace("#(^|[\n ])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $ret);
        $ret = preg_replace("#(^|[\n ])((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $ret);
        $ret = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $ret);
        $ret = substr($ret, 1);
        return $ret;
    }

//----------------------------------------------------------------------------

    public function mywordwrap($string) {
        $wrap = null;
        $skip = NULL;
        $returnvar = NULL;
        $length = strlen($string);

        for ($i = 0; $i <= $length; $i = $i + 1) {

            $char = substr($string, $i, 1);

            if ($char == "<")
                $skip = 1;
            elseif ($char == ">")
                $skip = 0;
            elseif ($char == " ")
                $wrap = 0;

            if ($skip == 0)
                $wrap = $wrap + 1;

            $returnvar = $returnvar . $char;

            if ($wrap > 9) { // alter this number to set the maximum word length
                $returnvar = $returnvar . "&#8203;";
                $wrap = 0;
            }
        }

        return $returnvar;
    }

//-------------------------------------------------------
    public function msubstr($str, $from, $len) {
        return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $from . '}' .
                '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $len . '}).*#s', '$1', $str);
    }

//-------------------------------------------------------
    public function json_encode($a = false) {
        if (!function_exists('json_encode')) {
            if (is_null($a))
                return 'null';
            if ($a === false)
                return 'false';
            if ($a === true)
                return 'true';
            if (is_scalar($a)) {
                if (is_float($a)) {
// Always use "." for floats.
                    return floatval(str_replace(",", ".", strval($a)));
                }

                if (is_string($a)) {
                    static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
                    return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
                }
                else
                    return $a;
            }
            $isList = true;
            for ($i = 0, reset($a); $i < count($a); $i++, next($a)) {
                if (key($a) !== $i) {
                    $isList = false;
                    break;
                }
            }
            $result = array();
            if ($isList) {
                foreach ($a as $v)
                    $result[] = json_encode($v);
                return '[' . join(',', $result) . ']';
            } else {
                foreach ($a as $k => $v)
                    $result[] = json_encode($k) . ':' . json_encode($v);
                return '{' . join(',', $result) . '}';
            }
        }
    }

//----------------------------------------------------------------------
    public function check_perms() {
        if (($this->show_name == 'buddy' || $this->show_name == 'user') && $_SESSION[$this->uid . 'is_guest'] == 1) {
            $status = "guesthasnopermissions";
        } else if ($this->show_name == 'guest' && $_SESSION[$this->uid . 'is_guest'] == 1) {
            $status = "guesthaspermissions";
        } else if (($this->show_name == 'buddy' || $this->show_name == 'user' || $this->show_name == 'guest') && $_SESSION[$this->uid . 'is_guest'] == 0) {
            $status = "userloggedin";
        } else {
            $this->freichat_debug('Something seems to be wrong in ' . RDIR . '/server/freichat.php (get_members)');
        }
        return $status;
    }

//----------------------------------------------------------------------
    public function get_statusimg_url($status, $onlineimg, $busyimg) {


        $img_url = '';
        if ($status == 1 || $status == 4) {
            $status = "online";
            $img_url = $this->url . 'client/themes/' . $this->color . '/' . $onlineimg;
        } else if ($status == 3) {
            $status = "busy";
            $img_url = $this->url . 'client/themes/' . $this->color . '/' . $busyimg;
        } else {
            /* User should be offline or invisible */
        }

        return $img_url;
    }

//----------------------------------------------------------------------
//-------------CHATROOM RELATED CODE---------------//
//---------------------------------------------------------------------
//-------------------------------------------------------------------
    public function load_chatroom() {

        $freichat = new freichat_data();

        $active_room = (int) $_GET['in_room'];
        $_SESSION[$this->uid . 'in_room'] = $active_room;

        $chatroom_mesg_time = $_GET['chatroom_mesg_time'];

        $query2 = "SELECT  r.room_name,r.id as room_id,count(s.id) as online_count
                FROM frei_rooms as r
                LEFT   join  frei_session as s
                on r.id=s.in_room
                AND time>" . $this->online_time2 . "
                Group BY r.id,r.room_name,r.room_order ORDER BY r.room_order";


        $query = "UPDATE frei_session set in_room = " . $active_room . " WHERE permanent_id=" . $_SESSION[$this->uid . 'gst_ses_id'];
        $this->db->query($query);

        // commented v8.2
        $options = array(
            "id" => $_GET['id'],
            "custom_mesg" => htmlentities($_GET['custom_mesg'], ENT_QUOTES),
            "usr_list_wanted" => false,
            "first" => true,
            "in_room" => $active_room
        );

        $ob = $this->call_driver($options);
        $users = $ob->getList();

        $chatroom_user_array = array();

        //TODO: Remove this dependency
        require_once RDIR . '/client/themes/' . $this->color . '/argument.php';

        foreach ($users as $res) {

            $guest = $res['username'];
            $guest = strlen($guest) > 30 ? $this->msubstr($guest, 0, 16) . "..." : $guest;
            //$img_url = $this->get_statusimg_url($res['status'],$onlineimg,$busyimg);
            if ($this->linkprofile == 'enabled' && $res['guest'] == 0 && $_SESSION[$this->uid . "is_guest"] == 0) {
                //$profile_link = $object->linkprofile_url($res, $path, $profile_img);
                $guest = strlen($guest) > 18 ? $this->msubstr($guest, 0, 12) . "..." : $guest;
            }


            $avatar_url = "http://www.gravatar.com/avatar/" . md5($guest) . "?s=24&d=wavatar"; //$this->url . "/client/jquery/user.jpeg";

            if (isset($res[$this->avatar_field_name])) {

                if ($res[$this->avatar_field_name] != "") {
                    $avatar_url = $ob->avatar_url($res[$this->avatar_field_name]);
                } else {
                    $avatar_url = "http://www.gravatar.com/avatar/" . md5($guest) . "?s=24&d=wavatar";
                }
            }

            $guest = str_replace("'", " ", $guest);

            if ($active_room == $res['in_room']) {

                $img_url = $this->get_statusimg_url($res['status'], $onlineimg, $busyimg);
                $chatroom_user_array[] = array("username" => $guest, "userid" => $res['session_id'], "avatar" => $avatar_url, "img_url" => $img_url);
            }
        }



        $curr_time = $_GET['time'];


        $users = $ob->get_chatroom_users($chatroom_user_array);
        $messages = $this->get_chatroom_messages($active_room, 'multi', $chatroom_mesg_time);
        $rooms = $this->db->query($query2)->fetchAll();
        $get_mesg = $this->get_messages($_GET['time']);
        $last_mesg_time = $this->get_last_message_time($get_mesg, $curr_time);
        $chatroom_mesg_time = $this->get_last_message_time($this->chatroom_raw_mesgs, $chatroom_mesg_time);
        //  $this->delete_messages();
        $this->update_messages($active_room);


        $freichat->room_array = $rooms;
        $freichat->chatroom_users_div = $users;
        $freichat->in_room = $active_room;
        $freichat->chatroom_messages = $messages;
        $freichat->messages = $get_mesg;
        $freichat->time = $last_mesg_time;
        $freichat->chatroom_mesg_time = $chatroom_mesg_time;

// $freichat->username = $usr_name;
//$freichat->message = $messages;
        //echo $_SESSION[$this->uid . "in_room"];
        echo json_encode($freichat);
    }

//-------------------------------------------------------------------
    private function lim_top($lim) {
//if only the standards provided the limits
//limit -> mysql,postgresql,sqlite
//top -> mssql 

        if ($this->pdo_driver == "sqlsrv") {
            return array(" TOP $lim ", " ");
        } else {
            return array(" ", " LIMIT $lim ");
        }
    }

//-------------------------------------------------------------------
    public function get_chatroom_messages($active_room, $all, $time = null) {

        $frm_id = $this->frm_id;

        if ($active_room == -1) {
            $active_room = 0;
        }
        if(isset($_GET['mobile'])) {
            $room_cond = "";
        }else{
            $room_cond = 'AND f.room_id=' . $active_room;
        }
        
        $lim = $this->lim_top(50);

        if ($all == 'multi') {
            $get_mesg_query = "SELECT DISTINCT $lim[0] * FROM frei_chat WHERE room_id=" . $active_room . " AND message_type=1 order by time DESC $lim[1]";
            //echo $get_mesg_query;
        } else if ($all === 'single') {
            
            $get_mesg_query = "SELECT DISTINCT * FROM frei_chat AS f  WHERE f.\"from\" != " . $frm_id . " ". $room_cond ." AND f.time> " . $time . "  AND f.message_type=1 order by time DESC";
        } else {
            $get_mesg_query = "SELECT DISTINCT $lim[0] * FROM frei_chat WHERE room_id=1 AND message_type=1 order by time DESC $lim[1]";
        }

        $this->chatroom_raw_mesgs = array_reverse($this->db->query($get_mesg_query)->fetchAll());
//var_dump($this->chatroom_raw_mesgs);
        return $this->chatroom_raw_mesgs;
    }

//----------------------------------------------------------------------
    /*  public function delete_messages() {
      if (isset($_SESSION[$this->uid . 'delay'])) {
      if ($_SESSION[$this->uid . 'delay'] > 50) {
      $_SESSION[$this->uid . 'delay'] = 0;
     * 
     * NOTE: if you want to use this func. keep in mind the **microtime** 

      $delete_mesg_query = "DELETE FROM frei_chat  WHERE recd =1 AND sent < $this->mysql_now-" . $this->time;
      $this->db->query($delete_mesg_query);
      } else {
      $_SESSION[$this->uid . 'delay'] = $_SESSION[$this->uid . 'delay'] + 5;
      }
      } else {
      $_SESSION[$this->uid . 'delay'] = 0;
      }
      }
     */
//----------------------------------------------------------------------
    public function update_messages($active_room) {
        $update_mesg_query = "UPDATE frei_chat set recd = 1 WHERE (frei_chat.\"to\" = " . $this->frm_id . " OR room_id=" . $active_room . ") AND recd = 0";
        $this->db->query($update_mesg_query);
    }

//----------------------------------------------------------------------
    public function get_last_message_time($get_mesg, $time) {


        if ($get_mesg != null) {
            $end_mesg = end($get_mesg);
            $time = $end_mesg['time'];
        }

        if ($time == 0) {
            $time = time() . str_replace(" ", "", microtime());
            return $time;
        }
        return $time;
    }

//----------------------------------------------------------------------
    public function call_driver($options) {

        $update_usr_info = false;

        if ($_SESSION[$this->uid . 'custom_mesg'] != $options['custom_mesg'] || $_SESSION[$this->uid . 'in_room'] != $options['in_room']) {
            $update_usr_info = true;
        }

        $sessions = new $this->driver($this->db);
        $sessions->uid = $this->uid;
        $sessions->permanent_name = $this->permanent_name;
        $sessions->permanent_id = $this->permanent_id;
        $sessions->online_time = $this->online_time;
        $sessions->online_time2 = $this->online_time2;
        $sessions->time_string = $this->time_string;
        $sessions->show_name = $this->show_name;
        $sessions->options = $options;
        $sessions->usr_list_wanted = $options['usr_list_wanted'];
        $sessions->db_prefix = $this->db_prefix;
        $sessions->displayname = $this->displayname;
        $sessions->frei_trans = $this->frei_trans;
        $sessions->debug = $this->debug;
        $sessions->update_usr_info = $update_usr_info;
        $sessions->url = $this->url;
        $sessions->driver = $this->driver;
        $sessions->to_freichat_path = $this->to_freichat_path;
        $sessions->long_polling = $this->long_polling;
        $sessions->sef_link_profile = $this->sef_link_profile;
        $sessions->ug_ids = $this->ug_ids;
        $sessions->avatar_field_name = $this->avatar_field_name;

        $sessions->row_username = $this->row_username;
        $sessions->row_userid = $this->row_userid;
        $sessions->usertable = $this->usertable;
        $sessions->use_cookie = $this->use_cookie;
        $sessions->pdo_driver = $this->pdo_driver;

        return $sessions;
    }

//----------------------------------------------------------------------
    public function get_messages($time) {

        $frm_id = $this->frm_id;
        $result = array();

        if ($time == 0) {
//$get_mesg_query = "SELECT DISTINCT * FROM frei_chat WHERE frei_chat.\"to\"=" . $frm_id . "AND time<2 order by time";
        } else {
            $get_mesg_query = "SELECT * FROM frei_chat WHERE frei_chat.\"to\"=" . $frm_id . " AND time>" . $time . " AND message_type<>1 order by time ";
            $result = $this->db->query($get_mesg_query)->fetchAll();
        }


        return $result;
    }

//----------------------------------------------------------------------
    public function get_members() {

        $freichat = new freichat_data();

        $onlcnt = 0;
        $online_time = $this->online_time2;
        $text = array();
        $guest = NULL;
        //$freichat->user_array = array();
        //$freichat->id_array = array();
        //$freichat->img_array = array();
        $freichat->userdata = array();

        if (isset($_SESSION[$this->uid . 'freistatus']) == false) {
            $_SESSION[$this->uid . 'freistatus'] = 1;
        }

        $active_room = (int) $_GET['in_room'];


        $update_usr_info = false;


        $_SESSION[$this->uid . 'in_room'] = $active_room;


        if (!isset($_SESSION[$this->uid . 'custom_mesg'])) {
            $_SESSION[$this->uid . 'custom_mesg'] = $this->frei_trans['default_status'];
        }

        $custom_mesg = htmlentities($_GET['custom_mesg'], ENT_QUOTES, "UTF-8");

        if ($_GET['custom_mesg'] != 'i am null') {
            $_SESSION[$this->uid . 'custom_mesg'] = $custom_mesg;
        }

        $first = $_GET['first'];

        $options = array(
            "id" => $_GET['id'],
            "custom_mesg" => $custom_mesg,
            "usr_list_wanted" => true,
            "first" => $_GET['first'],
            "in_room" => $active_room
        );

        $object = $this->call_driver($options);
        $result = $object->load_driver();
        //var_dump($result);
        $profile_link = '';
        $profile_img = $this->url . 'client/themes/' . $this->color . '/profilelink.png';
        $path = str_replace($this->to_freichat_path, "", $this->url);
//for($i=0;$i<=10;$i++){
        //TODO: remove this dependency
        require_once RDIR . '/client/themes/' . $this->color . '/argument.php';
        $active_room = $_SESSION[$this->uid . 'in_room'];

        $chatroom_user_array = array();

        foreach ($result as $res) {

            $guest = $res['username'];
            $guest = strlen($guest) > 30 ? $this->msubstr($guest, 0, 16) . "..." : $guest;
            $img_url = $this->get_statusimg_url($res['status'], $onlineimg, $busyimg);
            if ($this->linkprofile == 'enabled' && $res['guest'] == 0 && $_SESSION[$this->uid . "is_guest"] == 0) {
                $profile_link = $object->linkprofile_url($res, $path, $profile_img);
                $guest = strlen($guest) > 18 ? $this->msubstr($guest, 0, 12) . "..." : $guest;
            }


            $avatar_url = "http://www.gravatar.com/avatar/" . md5($guest) . "?s=24&d=wavatar"; //$this->url . "/client/jquery/user.jpeg";
            //->is_avatar => if avatar is not fetched from DB eg. phpBB
            //$object->user_id = $res['session_id'];
            //$object->x_config = $this->x_config;

            if (isset($res[$this->avatar_field_name])) {

                if ($res[$this->avatar_field_name] != "") {
                    $avatar_url = $object->avatar_url($res);
                } else {
                    $avatar_url = "http://www.gravatar.com/avatar/" . md5($guest) . "?s=24&d=wavatar";
                }
            }

            $guest = str_replace("'", " ", $guest);

// $text.="<span  onmousedown=\"FreiChat.createChatBoxmesg('" . $guest . "','" . $res['session_id'] . "')\"><a title='" . $res['status_mesg'] . "' class=\"online-usr-list\" href='javascript:void(0)'><span style='display:" . $this->show_avatar . "'><img src='" . $avatar_url . "' height='22' width='22' alt='avatar' align='left'/></span>&nbsp;<img style='padding:4px;'src='" . $img_url . "' height='12' width='12' alt='status' align='right'/>" . (strlen($guest) > 13 ? $this->msubstr($guest, 0, 10) . "..." : $guest) . "</a></span><hr style='margin-top:5px;margin-bottom:5px;color:black'/>";
//if(!isset($_GET['mobile'] == true)) {
//}
            /* $freichat->userdata[] = "<div id='freichat_user_" . $res['session_id'] . "' title='" . $res['status_mesg'] . "'  onmousedown=\"FreiChat.create_chat_window_mesg('" . $guest . "','" . $res['session_id'] . "')\" class=\"freichat_userlist\" onmouseover='FreiChat.show_profilelink(" . $res['session_id'] . ")' onmouseout='FreiChat.hide_profilelink(" . $res['session_id'] . ")'>
              <span >
              <span style='display:" . $this->show_avatar . "' class='freichat_userscontentavatar'><img src='" . $avatar_url . "' height='22' width='22' alt='avatar' align='left' class='freichat_userscontentavatarimage'/></span>
              </span>
              <span class=\"freichat_userscontentname\">" . (strlen($guest) > 20 ? $this->msubstr($guest, 0, 10) . "..." : $guest) . "</span>
              <span >&nbsp;<img class ='freichat_userscontentstatus' style='padding-top:4px; padding-right:4px;' src='" . $img_url . "' height='12' width='12' alt='status' /></span>" . $profile_link . "
              </div>"; */
            $onlcnt++;
            /* $freichat->user_array[] = $guest;
              $freichat->img_array[] = $avatar_url;
             */

            $show_name = (strlen($guest) > 20 ? $this->msubstr($guest, 0, 10) . "..." : $guest);

            if ((isset($res['in_room']) && $active_room == $res['in_room']) && $this->show_chatroom_plugin == 'enabled') {
                $chatroom_user_array[] = array("username" => $guest, "userid" => $res['session_id'], "avatar" => $avatar_url, "img_url" => $img_url);
            }

            $freichat->userdata[] = array(
                "username" => $guest,
                "userid" => $res['session_id'],
                "avatar" => $avatar_url,
                "img_url" => $img_url,
                "show_name" => $show_name,
                "status_mesg" => $res['status_mesg'],
                "profile_link" => $profile_link
            );


            //$logged = true;
        }
//}
        //$frm_id = $this->frm_id;

        /*
          if ($this->is_mobile == 1) {
          $uniqueids = array();
          }
          else
          $uniqueids = $_GET['uniqueids'];
         */

        if ($this->show_chatroom_plugin == 'enabled') {

            if ($first == 'false') {

                $query2 = "SELECT  r.room_name,r.id as room_id,count(s.id) as online_count
                    FROM frei_rooms as r
                    LEFT   join  frei_session as s
                    on r.id=s.in_room
                    AND s.time > " . $this->online_time2 . "
                    Group BY r.id,r.room_name,r.room_order ORDER BY r.room_order";

                //$users = $object->get_chatroom_users($chatroom_user_array);

                $rooms = $this->db->query($query2)->fetchAll();
                $freichat->room_array = array();
                $freichat->room_array = $rooms;
            }


            $query3 = "SELECT  count(s.id) as online_count
                    FROM frei_rooms as r
                    LEFT   join  frei_session as s
                    on r.id=s.in_room
                    AND s.time > " . $this->online_time2 . "
                    Group BY r.id,r.room_order ORDER BY r.room_order";
            $freichat->room_online_count = $this->db->query($query3)->fetchAll();

            $freichat->chatroom_users_array = $chatroom_user_array;
            $freichat->in_room = $active_room;
        }
//$this->change_custom_status_mesg($_GET['custom_mesg']);     

        $freichat->islog = $this->check_perms();
        $freichat->status = $_SESSION[$this->uid . 'freistatus'];

        // $freichat->userdata[] = $text;
        $freichat->count = $onlcnt;
        $freichat->username = str_replace("'", "", $this->frm_name);
        $freichat->userid = $this->frm_id;
        $freichat->is_guest = $_SESSION[$this->uid . 'is_guest'];


        if (is_array($_GET['clrchtids'])) {
            if ($_GET['clrchtids'][0] != '') {
                $this->clrcht($_GET["clrchtids"]);
            }
        }

        if ($this->long_polling == "enabled" && $_GET['long_poll'] != 'false' && isset($_SESSION[$this->uid . 'main_loaded'])) {
            session_write_close();
            $new_data = false;

            $time = time();
            while ((time() - $time) < $this->poll_time) {
                // $new_data = array();    



                $freichat = $this->update_message_data($freichat, $uniqueids);
                if ($freichat->time > $_GET['time'] /* || $this->isset_video_offer == true */) {
                    // a new message !
                    $new_data = true;
                }

                /* if ($this->show_videochat_plugin == "enabled") {
                  if ($freichat->video_mesg_time > $_GET['video_mesg_time']) {
                  // a new message
                  $new_data = true;
                  }
                  } */



                if ($this->show_chatroom_plugin == "enabled") {
                    if ($freichat->chatroom_mesg_time > $_GET['chatroom_mesg_time']) {
                        // a new message 
                        $new_data = true;
                    }
                }


                if ($new_data == true) {
                    echo json_encode($freichat);
                    break;
                }

                usleep(($this->chatspeed * 1000));
            }

            if ($new_data == false) {
                echo json_encode($freichat);
            }
        } else {


            $freichat = $this->update_message_data($freichat);
            echo json_encode($freichat);
        }
    }

//-------------------------------------------------------------------    
    public function make_array($arr) {
        foreach ($arr as $array)
            return explode(",", $array);
    }

//-------------------------------------------------------------------
    public function get_video_offers() {

        $rid = (int) $_GET['rid'];
        $time = $_GET['time'];

        $sql = 'SELECT msg_type AS "type" , msg_label AS "label", msg_data AS "data", msg_time AS "time"
                    FROM frei_video_session WHERE from_id!= ? AND rid= ? AND msg_time>?';
        $query = $this->db->prepare($sql);

        $arr = array($this->frm_id, $rid, $time);
        $query->execute($arr);
        $msgs = $query->fetchAll();

        $n_time = $this->get_last_message_time($msgs, $time);

        $result = array(
            "msgs" => $msgs,
            "time" => $n_time
        );

        echo json_encode($result);
    }

//-------------------------------------------------------------------------
    public function get_video_details() {

        $rid = (int) $_GET['rid'];

        $query = "SELECT from_id, msg_data FROM frei_video_session WHERE id=$rid AND msg_label=3";
        $res = $this->db->query($query);

        $arr = array();

        //i know this is confusing :(
        foreach ($res as $result) {

            $data = json_decode($result['msg_data']);
            if ($result['from_id'] == $this->frm_id) {
                $arr['initiator'] = "no";
                $arr['toname'] = $data[3];
                $arr['to'] = $data[2];
                $arr['from'] = $this->frm_id;
                $arr['fromname'] = $this->frm_name;
            } else {
                $arr['initiator'] = "yes";
                $arr['toname'] = $data[1];
                $arr['to'] = $data[0];
                $arr['from'] = $this->frm_id;
                $arr['fromname'] = $this->frm_name;
            }
        }
        echo json_encode($arr);
    }

//-------------------------------------------------------------------------
    public function video() {

        $rid = (int) $_POST['rid'];
        $time = time() . str_replace(" ", "", microtime());
        $fromid = $this->frm_id;

        $query = "INSERT INTO frei_video_session (rid,from_id,msg_type,msg_label,msg_data,msg_time) VALUES (?,?,?,?,?,?)";
        $p_query = $this->db->prepare($query);

        /*
          if ($_POST['type'] == "candidate") {


          $messages_label = explode(",", $_POST['data2'][0]);
          $messages_data = explode(",", $_POST['data'][0]);

          $i = 0;
          foreach ($messages_label as $label) {
          $p_query->execute(array($rid, $_POST['type'], $label, $messages_data[$i], $time));
          $i++;
          }
          } else { */

        $label = 0;
        if ($_POST['type'] == "candidate") {
            $label = 1;
        }

        $param = array($rid, $fromid, $_POST['type'], $label, $_POST['data'], $time);
        $p_query->execute($param);
        //}
    }

//-------------------------------------------------------------------------

    public function gen_room_id() {
        $query = "INSERT INTO frei_video_session (from_id,msg_type,msg_label,msg_data,msg_time) 
                        VALUES (?, ?, ?, ?, ?)";
        $p_query = $this->db->prepare($query);

        $time = time() . str_replace(" ", "", microtime());
        $to = $this->get_clean_id($_POST['to']);
        $to_name = htmlentities($_POST['to_name'], ENT_QUOTES, "UTF-8");

        $data = json_encode(array(
           $to, $to_name , $this->frm_id, $this->frm_name
        ));
        
        $p_query->execute(array($to, "new", "3", $data, $time));

        $lastid = (int) $this->db->lastInsertId();

        return $lastid;
    }

//-------------------------------------------------------------------------

    public function create_video_session() {

        $type = $_POST['type'];

        $lastid = (int) $_POST['rid'];

        if ($type == "caller") {
            $lastid = $this->gen_room_id();
        }

        $this->prepare_insert_msg();

        $time = time() . str_replace(" ", "", microtime());
        $usr_name = str_replace("'", "", $this->frm_name);
        $GMT_time = $this->bigintval($_POST['GMT_time']);
        $frm_id = $this->frm_id;
        $to = $this->get_clean_id($_POST['to']);
        $to_name = htmlentities($_POST['to_name'], ENT_QUOTES, "UTF-8");

        $id = $_POST['id'];
        $xhash = $_POST['xhash'];
        $url = $this->url . "client/plugins/videochat/videochat.php?rid=$lastid&id=$id&xhash=$xhash";

        if ($type == "caller") {
            $message = '<div class="frei_video_request">' . $this->frei_trans["vid_req_rec"] . '<a  href="' . $url . '" target="_blank" onClick=\'FreiChat.sendvideo("' . $usr_name . '","' . $frm_id . '",2,' . $lastid . ')\'>' . $this->frei_trans['vid_start_call'] . '</a></div>';
        } else if ($type == "callee") {
            $message = '<div class="frei_video_request">' . $this->frei_trans["vid_req_accept"] . '<a href="' . $url . '" target="_blank" onClick=\'FreiChat.sendvideo("' . $usr_name . '","' . $frm_id . '",3,' . $lastid . ')\'>' . $this->frei_trans['vid_start_call'] . '</a></div>';
        } else {
            $message = 'ERR: 402: BAD REQUEST';
        }


        $this->insert_mesg_query->execute(array($frm_id, $usr_name, $to, $to_name, $message, $this->mysql_now, $time, 2, '-1', $GMT_time));
        echo json_encode($lastid);
    }

//-------------------------------------------------------------------
    public function update_message_data($freichat) {


        $curr_time = $_GET['time'];
        $chatroom_mesg_time = $_GET['chatroom_mesg_time'];
        $active_room = $_SESSION[$this->uid . 'in_room'];
        $get_mesg = $this->get_messages($curr_time);

        // $this->delete_messages();
        $this->update_messages($active_room);
        $freichat->time = $this->get_last_message_time($get_mesg, $curr_time);
        $freichat->messages = $get_mesg;

        /* if ($this->show_videochat_plugin == 'enabled') {

          if (isset($_GET['video_mesg_time'])) {
          $video_mesg_time = $_GET['video_mesg_time'];

          // if ($_GET['first'] == 'true')
          $uniqueids = $this->make_array($uniqueids);
          //$video_mesg_time = $this->make_array($video_mesg_time);
          $freichat->video_messages = $this->get_video_offers($video_mesg_time, $uniqueids);


          if (is_array($uniqueids)) {
          $i = 0;
          $freichat->video_mesg_time = array();
          foreach ($uniqueids as $uniqueid) {
          //echo $uniqueid;
          //   var_dump($freichat->video_messages);
          if (isset($freichat->video_messages[$uniqueid]))
          $freichat->video_mesg_time[$i] = $this->get_last_message_time($freichat->video_messages[$uniqueid], $video_mesg_time);
          else
          $freichat->video_mesg_time[$i] = $this->get_last_message_time(null, $video_mesg_time);
          $i++;
          }
          }

          if (is_array($freichat->video_mesg_time)) {
          $freichat->video_mesg_time = max($freichat->video_mesg_time);
          } else {
          $freichat->video_mesg_time = $video_mesg_time;
          }
          }
          } */
        if ($this->show_chatroom_plugin == 'enabled') {


            $chatroom_messages = null;
            if ($_GET['first'] == 'false') {
                $chatroom_messages = $this->get_chatroom_messages($active_room, 'multi', $chatroom_mesg_time);
            } else {
                $chatroom_messages = $this->get_chatroom_messages($active_room, 'single', $chatroom_mesg_time);
            }
            $freichat->chatroom_messages = $chatroom_messages;
            $last_chatroom_message = end($this->chatroom_raw_mesgs);
            $freichat->last_chatroom_usr_id = $last_chatroom_message['from'];

            $chatroom_mesg_time = $this->get_last_message_time($chatroom_messages, $chatroom_mesg_time);
            $freichat->chatroom_mesg_time = $chatroom_mesg_time;
        }

        return $freichat;
    }

//-------------------------------------------------------------------
    public function prepare_insert_msg() {
        $insert_mesg_query = "INSERT INTO frei_chat (frei_chat.\"from\",from_name,frei_chat.\"to\",to_name,message,frei_chat.\"sent\",frei_chat.\"time\",message_type,room_id,GMT_time) VALUES(?,?,?,?,?,?,?,?,?,?)";
        $this->insert_mesg_query = $this->db->prepare($insert_mesg_query);
    }

//-------------------------------------------------------------------
    public function post_mesg() {
        $freichat = new freichat_data();
        $frm_id = $this->frm_id;
        $usr_name = str_replace("'", "", $this->frm_name);
        $room_id = -1;

        if ($_POST['message_type'] == 0 || $_POST['message_type'] == 2) {
            if ($this->driver == "Sugarcrm") {
                $to = $_POST['to'];
            } else {
                $to = $this->bigintval($_POST['to']);
            }
        }

        /*
          0 => normal message
          1 => chatroom message
          2 => video request
         */


        $message_type = null;
        $chatroom_mesg_time = 0.00;
        $active_room = (int) $_POST['in_room'];


        if (isset($_POST['message_type'])) {

            $message_type = strip_tags($_POST['message_type']);
        }

        if (isset($_POST['in_room'])) {
            $room_id = (int) $_POST['in_room'];
        }
        $mesg = $_POST['message'];
        $last_mesg_time = null;
        $get_mesg = null;

        foreach ($mesg as $message) {
            if ($message_type > 1) {
                $messages = array($message);
            } else {
                $messages = explode(',', $message);
            }
        }


        $GMT_time = $this->bigintval($_POST['GMT_time']);
        $this->prepare_insert_msg();

        if ($_POST['to'] == 'FcX_AlIcE') {
            $_REQUEST['oreqmode'] = 'json';
            var_dump($messages);
            $_REQUEST['chatbotmessage'] = $messages[0];
            require '../client/plugins/bot/chat.php';
        }

        foreach ($messages as $message) {
            $message = nl2br($message);

            $to_name = htmlentities($_POST['to_name'], ENT_QUOTES, "UTF-8");
            $time = time() . str_replace(" ", "", microtime());
            if ($message_type == 0 || $message_type == 2) {
                $chatroom_mesg_time = $_POST['chatroom_mesg_time']; //echo $message_type;
                $this->insert_mesg_query->execute(array($frm_id, $usr_name, $to, $to_name, $message, $this->mysql_now, $time, $message_type, '-1', $GMT_time));
            } else {
                //$chatroom_mesg_time = $time;
                $chatroom_mesg_time = $_POST['chatroom_mesg_time'];
                $this->insert_mesg_query->execute(array($frm_id, $usr_name, $room_id, $room_id, $message, $this->mysql_now, $time, $message_type, $room_id, $GMT_time));
            }
        }

        $custom_mesg = htmlentities($_POST['custom_mesg'], ENT_QUOTES, "UTF-8");
        //settype($chatroom_mesg_time,"float");


        if ($_POST['passBYpost'] == true) {


            /* commented in v8.2
              $options = array(
              "id" => $_POST['id'],
              "custom_mesg" => $custom_mesg,
              "usr_list_wanted" => false,
              "first" => true,
              "in_room" => $active_room
              );


              $this->call_driver($options);
             */

            if (!isset($_SESSION[$this->uid . 'in_room'])) {
                $_SESSION[$this->uid . 'in_room'] = -1;
            }


            $freichat_time = $_POST['time'];
            //settype($freichat_time,"float");

            $get_mesg = $this->get_messages($freichat_time);
            $last_mesg_time = $this->get_last_message_time($get_mesg, $freichat_time);
            // $this->delete_messages();
            $this->update_messages($active_room);

            $_SESSION[$this->uid . 'custom_mesg'] = $custom_mesg;

            $freichat->chatroom_messages = $this->get_chatroom_messages($active_room, 'single', $chatroom_mesg_time);
            //$last_chatroom_message = end($this->chatroom_raw_mesgs);
            // $freichat->last_chatroom_usr_id = $last_chatroom_message['from'];
        }

        $freichat->messages = $get_mesg;
        $freichat->time = $last_mesg_time;
        $freichat->username = $usr_name;
        $freichat->message = $messages;
        $freichat->chatroom_mesg_time = $this->get_last_message_time($freichat->chatroom_messages, $chatroom_mesg_time);



        echo json_encode($freichat);
    }

//--------------------------------------------------------------------------
    public function get_clean_id($id) {
        if (!$this->driver == "Sugarcrm")
            return $this->bigintval($id);
        return $id;
    }

    public function get_data() {
        $freichat = new freichat_data();

        $frm_id = $this->frm_id;
        $exist = false;


        $getdata_query = "SELECT * FROM frei_chat WHERE (frei_chat.\"to\"=" . $frm_id . " OR frei_chat.\"from\"=" . $frm_id . ") AND message_type<>1 AND message_type<>2 order by time";
        $messages = $this->db->query($getdata_query)->fetchAll();


        foreach ($messages as $analyse) {
            if ($analyse == NULL) {
                $exist = false;
            } else {
                $exist = true;
            }
        }


        $freichat->exist = $exist;
        $freichat->messages = $messages;

        echo json_encode($freichat);
    }

//-------------------------------------------------------------------------------
    public function isset_msg() {
        $freichat = new freichat_data();
        $frm_id = $this->frm_id;
        $to_id = (int) $_GET['Cid'];


        if(isset($_GET['mobile']) && $_GET['mode'] == "chatroom") {
            $get_mesg = $this->get_chatroom_messages($_GET['active_room'], 'multi');            
        }else{
            $isset_mesg_query = "SELECT * FROM frei_chat WHERE ((frei_chat.\"to\"=" . $frm_id . " AND frei_chat.\"from\"=" . $this->db->quote($to_id) . ") OR (frei_chat.\"from\"=" . $frm_id . " AND frei_chat.\"to\"=" . $this->db->quote($to_id) . ") ) AND message_type <> 2 order by time";
            $get_mesg = $this->db->query($isset_mesg_query)->fetchAll();            
        }


        
        $freichat->messages = $get_mesg;
        $analyze = $freichat->messages;
        $exist = false;
        foreach ($analyze as $analyse) {
            if ($analyse == NULL) {
                $exist = false;
            } else {
                $exist = true;
            }
        }
        $freichat->exist = $exist;
        echo json_encode($freichat);
    }

//-------------------------------------------------------------------------------
    public function clrcht($id) {
        $id = implode(',', $id);

        $clrcht_query = "DELETE FROM frei_chat where (frei_chat.\"to\" IN (" . $this->db->quote($id) . ") AND  frei_chat.\"from\" IN(" . $this->frm_id . ")) OR (frei_chat.\"from\" IN(" . $this->db->quote($id) . ") AND  frei_chat.\"to\" IN(" . $this->frm_id . "))";
        $this->db->query($clrcht_query);
    }

//---------------------------------------------------------------------------------
    public function update_status() {
        $freichat = new freichat_data();
        $user_id = $_SESSION[$this->uid . 'gst_ses_id'];
        $freistatus = (int) $_POST['freistatus'];

        if ($_SESSION[$this->uid . 'freistatus'] != $_POST['freistatus']) {
            $freistatus = ($freistatus == 4) ? 3 : $freistatus;

            $query = "UPDATE frei_session set status=" . $this->db->quote($freistatus) . " WHERE permanent_id=" . $user_id;
            $this->db->query($query);
        }

        $_SESSION[$this->uid . 'freistatus'] = (int) $_POST['freistatus'];

        $freichat->status = (int) $_POST['freistatus'];
        $freichat->id = $user_id;
        echo json_encode($freichat);
    }

//---------------------------------------------------------------------------------

    public function get_new_messages_mobile() {

        //offcourse everything here relates to messages so no prefix message_

        $freichat = new freichat_data();

        $last_rec_time = $_GET['last_rec_time'];

        $messages = $this->get_messages($last_rec_time);
        $last_rec_time = $this->get_last_message_time($messages, $last_rec_time);

        $freichat->messages = $messages;
        $freichat->last_rec_time = $last_rec_time;

        echo json_encode($freichat);
    }

//---------------------------------------------------------------------------------
}

/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */

$freichat = new freichatX();

if ($_REQUEST['freimode'] == "getmembers") {
    $freichat->get_members();
} else if ($_REQUEST['freimode'] == "post") {
    $freichat->post_mesg();
} else if ($_REQUEST['freimode'] == "getdata") {
    $freichat->get_data();
} else if ($_REQUEST['freimode'] == "clrcht") {
    $freichat->clrcht();
} else if ($_REQUEST['freimode'] == "update_status") {
    $freichat->update_status();
} else if ($_REQUEST['freimode'] == "isset_mesg") {
    $freichat->isset_msg();
} else if ($_REQUEST['freimode'] == "sendvideo") {
    $freichat->video_request();
} else if ($_REQUEST['freimode'] == "loadchatroom") {
    $freichat->load_chatroom();
} else if ($_REQUEST['freimode'] == "video") {
    $freichat->video();
} else if ($_REQUEST['freimode'] == "create_video_session") {
    $freichat->create_video_session();
} else if ($_REQUEST['freimode'] == "get_video_offers") {
    $freichat->get_video_offers();
} else if ($_REQUEST['freimode'] == "get_video_details") {
    $freichat->get_video_details();
} else if ($_REQUEST['freimode'] == "get_new_messages_mobile") {
    $freichat->get_new_messages_mobile();
} else {
    echo "Request Not Working!";
    $freichat->freichat_debug("Request Not Working!");
}


//file_put_contents("memusage.txt","\n ".$_REQUEST['freimode'].": ".memory_get_peak_usage(),FILE_APPEND); 


if (isset($_SESSION[$freichat->uid . 'usr_name']) == false) {
    echo "Unable To Store In session";
    $freichat->freichat_debug("Unable to store in session");
    var_dump($_SESSION);
}
