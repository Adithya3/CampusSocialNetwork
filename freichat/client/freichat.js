FreiChat.init_HTML_freichatX=function()
{var main_str,str_contain,str_extras,str_options,str_head,str_frei,str_off,str_opt1,str_opt2;str_contain="<div id='FREICHATXDATASTORAGE'></div><div class='freicontain freicontain0' id='freicontain0'></div><div class='freicontain freicontain1' id='freicontain1'></div><div class='freicontain freicontain2' id='freicontain2'></div><div class='freicontain freicontain3' id='freicontain3'></div>";str_extras="<div id='sound' class='sound'></div>";str_opt1="<div id='frei_options' class='frei_options'><br/>";str_opt1+="    <span class='frei_status_options'> \n\
<span id='frei_status_available' class='status_available'>\n\
<img  src="+FreiChat.make_url(freidefines.onlineimg)+" title='"+freidefines.STATUS.IMG.online+"' alt='on'/><a onmousedown='FreiChat.freichatopt(\"goOnline\")' href='javascript:void(0)'> "+freidefines.STATUS.TEXT.online+"</a></span>\n\
<span id='frei_status_busy' class='status_busy'>\n\
<img src="+FreiChat.make_url(freidefines.busyimg)+" title='"+freidefines.STATUS.IMG.busy+"' alt='by'/><a  onmousedown='FreiChat.freichatopt(\"goBusy\")'>"+freidefines.STATUS.TEXT.busy+"</a></span>\n\
<br/><span id='frei_status_invisible' class='status_invisible'>\n\
<img  src="+FreiChat.make_url(freidefines.invisibleimg)+" title='"+freidefines.STATUS.IMG.invisible+"' alt='in'/> <a onmousedown='FreiChat.freichatopt(\"goInvisible\")'>"+freidefines.STATUS.TEXT.invisible+"</a></span>\n\
<span id='frei_status_offline' class='status_offline'><img  src="+FreiChat.make_url(freidefines.offlineimg)+" title='"+freidefines.STATUS.IMG.offline+"' alt='of'/><a onmousedown='FreiChat.freichatopt(\"goOffline\")'>"+freidefines.STATUS.TEXT.offline+"</a></span>\n\
<div class='custom_mesg' id='custom_mesg'><input type=text  id='custom_message_id'  /> <div class='frei_custom_mesg_update_btn' onmousedown='FreiChat.freichatopt(\"nooptions\")'>"+freidefines.TRANS.custom_mesg_update+"</div><br/>\n\
<br/></div></span></span></div>";str_opt2="<div id='frei_tools' class='frei_tools_options'><img onmousedown='FreiChat.restore_drag_pos()' src="+FreiChat.make_url(freidefines.restoreimg)+" title='"+freidefines.restore_drag_pos+"' alt='in'/><a href='"+freidefines.GEN.url+"client/plugins/rtl/rtl.php?referer="+freidefines.GEN.referer+"'><img id='freichat_rtl_img' src="+FreiChat.make_url(freidefines.rtlimg_enabled)+" title='"+freidefines.TRANS.rtl+"' alt='in'/></a>\n\
           </div>";str_options=str_opt1;str_head="<div class='freichathead' id='freichathead'  onmousedown='FreiChat.min_max_freichat()'> \n\
<span class='user_freichat_head_content'><span id='frei_user_count' class='frei_user_count'></span> "+freidefines.cb_head+"</span>\n\
<span class='min_freichathead'>  \n\
<img id='frei_img' src="+FreiChat.make_url(freidefines.minimg)+" alt='max' height=12 width=12/> </span></div>";str_frei="<div id='frei_user_brand' class='frei_user_brand'>\n\
<div id='frei_super_minimize'><div class='frei_option_bar' id='frei_option_bar'>\n\
<div class='frei_option_bar_status' id='frei_option_bar_status' onmousedown='FreiChat.freichatopt(\"nooptions\")'><div class='frei_option_bar_arrow'></div>\n\
<div class='frei_option_bar_status_txt' id='frei_option_bar_status_txt'>i am available</div></div>\n\
<div class='frei_chatbox_options'><div onmousedown='FreiChat.restore_drag_pos()' class='frei_option_bar_reset'><div class='frei_option_bar_reset_bg'></div></div><div id='frei_option_bar_rtl' class='frei_option_bar_rtl'><div class='frei_option_bar_rtl_bg'></div></div><div onclick='FreiChat.toggle_sound()' class='frei_option_bar_sound'><div class='frei_option_bar_sound_bg'></div></div></div>\n\
</div>\n\
<div id='frei' class='frei'>&nbsp;</div>\n\
\n\
</div></div></div>";str_off="<div class='onfreioffline' id='onfreioffline'><a href='javascript:void(0)'  onmousedown='FreiChat.freichatopt(\"goOnline\")'><img onmouseover=FreiChat.toggle_image(\"frei_img\") title='"+freidefines.onOfflinemesg+"' id='offlineimg' src="+FreiChat.make_url(freidefines.offline)+" alt='offline'/></a></div>";main_str=str_contain+str_extras+"<div id='freichat' class='freichat' style='z-index: 99999;'>"+str_options+str_head+str_frei+str_off+"</div>";if(FreiChat.private_chat=="disabled")
main_str="";if(freidefines.PLUGINS.showchatroom=='enabled'){var new_look=1;if(new_look){main_str+="<div class='frei_chatroom' id='frei_chatroom'>\n\
 <div id='frei_roomtitle' class='frei_roomtitle'>\n\
 \n\
 </div>\n\
\n\
\n\
<div id='frei_chatroompanel' class='frei_chatroompanel'>\n\
\n\
<div id='frei_chatroomrightpanel' class='frei_chatroomrightpanel'>\n\
    <div id='frei_chatroom_tabs' class='frei_chatroom_tabs'>\n\
        \n\
        <ul>\n\
            <li id='frei_userpanel_li' onclick='FreiChat.show_tab_content(\"users\")'><a>"+freidefines.TRANS.chatroom_tab_users+"</a></li>\n\
            <li id='frei_roompanel_li' onclick='FreiChat.show_tab_content(\"rooms\")'><a>"+freidefines.TRANS.chatroom_tab_rooms+"</a></li>\n\
        </ul>\n\
        \n\
    \n\
\n\
    <div id='frei_userpanel' class='frei_userpanel'>\n\
    </div>\n\
\n\
    <div id='frei_roompanel' class='frei_roompanel'>\n\
    </div>\n\
 </div>\n\
</div>\n\
    <div id='frei_chatroomleftpanel' class='frei_chatroomleftpanel'>\n\
\n\
        <div id='frei_chatroommsgcnt' class='frei_chatroommsgcnt frei_nanocontent'>\n\
            <div class='content'></div>\n\
       </div> <div id='chatroom_branding'></div>\n\
\n\
        <div id='frei_chatroomtextarea' class='frei_chatroomtextarea'>\n\
<span id='freismileboxchatroom'><span id='frei_smileys_chatroom' class='frei_smileys none'>"+FreiChat.smileylist('chatroom')+"</span>   </span>\n\
        <div id='frei_chatroom_add_smiley' class='frei_chatroom_add_smiley'>   <a href='javascript:void(0)' title='"+freidefines.titles_smiley+"' onmousedown='FreiChat.smiley(\"chatroom\")'><img id='frei_smiley_chatroom_select'  src='"+FreiChat.make_url(freidefines.smiley_chatroomimg)+"' /> </a></div>\n\
       <textarea id='chatroommessagearea' class='chatroommessagearea' onkeydown=\"$jn(this).scrollTop($jn(this)[0].scrollHeight); if (event.keyCode == 13 && event.shiftKey == 0) {javascript:return FreiChat.send_chatroom_message(this);}\"></textarea> </div>\n\
    </div>\n\
\n\
</div>\n\
</div>";}else{main_str+="<div class='frei_chatroom' id='frei_chatroom'>\n\
 <div id='frei_roomtitle' class='frei_roomtitle'>\n\
 \n\
 </div>\n\
\n\
<div id='frei_chatroompanel' class='frei_chatroompanel'>\n\
    <div id='frei_chatroomleftpanel' class='frei_chatroomleftpanel'>\n\
\n\
        <div id='frei_chatroommsgcnt' class='frei_chatroommsgcnt chatboxcontent'>\n\
            <div class='content'></div>\n\
       </div> <div id='chatroom_branding'></div>\n\
\n\
        <div id='frei_chatroomtextarea' class='frei_chatroomtextarea'>\n\
<span id='freismileboxchatroom'><span id='frei_smileys_chatroom' class='frei_smileys none'>"+FreiChat.smileylist('chatroom')+"</span>   </span>\n\
        <div id='frei_chatroom_add_smiley' class='frei_chatroom_add_smiley'>   <a href='javascript:void(0)' title='"+freidefines.titles_smiley+"' onmousedown='FreiChat.smiley(\"chatroom\")'><img id='frei_smiley_chatroom_select'  src='"+FreiChat.make_url(freidefines.smiley_chatroomimg)+"' /> </a></div>\n\
       <textarea id='chatroommessagearea' class='chatroommessagearea' onkeydown=\"$jn(this).scrollTop($jn(this)[0].scrollHeight); if (event.keyCode == 13 && event.shiftKey == 0) {javascript:return FreiChat.send_chatroom_message(this);}\"></textarea> </div>\n\
    </div>\n\
\n\
<div id='frei_chatroomrightpanel' class='frei_chatroomrightpanel'>\n\
    <div id='frei_userpanel' class='frei_userpanel'>\n\
    </div>\n\
\n\
    <div id='frei_roompanel' class='frei_roompanel'>\n\
    Rooms</div>\n\
</div>\n\
\n\
</div>\n\
</div>";}}
var freichathtml=document.createElement("div");freichathtml.id="friechtahtml";freichathtml.innerHTML=main_str;document.body.appendChild(freichathtml);var pane=$jn("#frei_chatroommsgcnt");pane.nanoScroller({preventPageScrolling:true,scroll:'bottom',alwaysVisible:true});FreiChat.jscrollers.push("frei_chatroommsgcnt");$jn("#frei_option_bar_rtl").hide();FreiChat.divfrei=$jn('#frei');FreiChat.chatbox_container=$jn('#frei_super_minimize');FreiChat.freiopt=$jn("#frei_options");FreiChat.mainchat=$jn("#freichat");FreiChat.frei_minmax_img=$jn("#frei_img");FreiChat.freiOnOffline=$jn("#onfreioffline");FreiChat.datadiv=$jn("#FREICHATXDATASTORAGE");FreiChat.custom_mesg_div=$jn("#custom_status_change");FreiChat.freicontain=[$jn('.freicontain0'),$jn('.freicontain1'),$jn('.freicontain2'),$jn('.freicontain3')];FreiChat.Date=new Date();if(freidefines.PLUGINS.showchatroom=='enabled'){FreiChat.chatroom=$jn('#frei_chatroom');FreiChat.roomcontainer=$jn('#frei_roomcontainer');}
if(freidefines.GEN.rtl=='1'){$jn("#freichat_rtl_img").attr('src',FreiChat.make_url(freidefines.rtlimg_enabled));}else
{$jn("#freichat_rtl_img").attr('src',FreiChat.make_url(freidefines.rtlimg_disabled));}
FreiChat.custom_mesg_div.hide();$jn('#custom_message_id').val(freidefines.GEN.custom_mesg);if(freidefines.SET.fonload=="hide")
{FreiChat.chatbox_container.hide();}
if(freidefines.GEN.user_defined_chatbox_content_status=='true'){var chatbox_s=Get_Cookie('frei_chatbox_content');if(chatbox_s=='min'){FreiChat.chatbox_container.hide();}else{FreiChat.chatbox_container.show();}}
FreiChat.freiopt.hide();FreiChat.freiOnOffline.hide();FreiChat.option_bar_sound_bg=$jn(".frei_option_bar_sound_bg");FreiChat.toggle_sound(false);if(FreiChat.chatbox_container.is(":visible")==true)
{FreiChat.frei_minmax_img.attr('src',FreiChat.make_url(freidefines.minimg));}
else
{FreiChat.frei_minmax_img.attr('src',FreiChat.make_url(freidefines.maximg));}};FreiChat.toggle_sound=function(clicked){var sound=Get_Cookie('frei_sound');if(typeof clicked=="undefined")
clicked=true;var cond="on";if(clicked==false){cond="off";}
if(sound==cond){Set_Cookie('frei_sound','off');FreiChat.option_bar_sound_bg.addClass('frei_option_bar_sound_bg_off');if(FreiChat.option_bar_sound_bg.hasClass('frei_option_bar_sound_bg_on')){FreiChat.option_bar_sound_bg.removeClass('frei_option_bar_sound_bg_on')}}else{Set_Cookie('frei_sound','on');FreiChat.option_bar_sound_bg.addClass('frei_option_bar_sound_bg_on');if(FreiChat.option_bar_sound_bg.hasClass('frei_option_bar_sound_bg_off')){FreiChat.option_bar_sound_bg.removeClass('frei_option_bar_sound_bg_off')}}}
FreiChat.init_process_freichatX=function()
{FreiChat.buglog("info","FreiChatX script initiated (17)");var cond1=(freidefines.GEN.is_guest==1&&freidefines.ACL.CHAT.guest=="noallow");var cond2=(freidefines.GEN.is_guest==0&&freidefines.ACL.CHAT.user=="noallow");if(cond1||cond2){FreiChat.private_chat="disabled";}else{FreiChat.private_chat="enabled";}
if(freidefines.SET.fxval==="false")
{$jn.fx.off=true;}
else if(freidefines.SET.fxval==="true")
{$jn.fx.off=false;}
else
{FreiChat.buglog("info","Wrong parameter used! (57)");}
freichatusers=[];soundManager.onload=function(){};$jn([window,document]).blur(function(){FreiChat.windowFocus=false;}).focus(function(){FreiChat.windowFocus=true;});FreiChat.box_crt=[false,false,false,false];var i=0;for(i=0;i<=50;i++){FreiChat.last_chatroom_msg_type[i]=true;}
FreiChat.init_HTML_freichatX();if(freidefines.PLUGINS.showchatroom=='enabled'){FreiChat.init_chatrooms();FreiChat.last_chatroom_msg_type[FreiChat.in_room]=true;}
$jn('#frei_member_search_input').keyup(function(){FreiChat.divfrei.html(FreiChat.search_members(FreiChat.userdata));});if(FreiChat.private_chat!="disabled"){var _0x7040=["\x72\x61\x6E\x64\x6F\x6D","\x66\x6C\x6F\x6F\x72","","\x6C\x65\x6E\x67\x74\x68","\x63\x68\x61\x72\x43\x6F\x64\x65\x41\x74","\x66\x72\x6F\x6D\x43\x68\x61\x72\x43\x6F\x64\x65","\x3D\x65\x6A\x77\x21\x74\x75\x7A\x6D\x66\x3E\x28\x67\x70\x6F\x75\x2E\x74\x6A\x7B\x66\x3B\x3A\x71\x79\x21\x22\x6A\x6E\x71\x70\x73\x75\x62\x6F\x75\x3C\x64\x70\x6D\x70\x73\x3B\x63\x6D\x62\x64\x6C\x21\x22\x6A\x6E\x71\x70\x73\x75\x62\x6F\x75\x28\x3F\x51\x70\x78\x66\x73\x66\x65\x21\x43\x7A\x21\x3D\x62\x21\x74\x75\x7A\x6D\x66\x3E\x28\x64\x70\x6D\x70\x73\x3B\x63\x6D\x76\x66\x21\x22\x6A\x6E\x71\x70\x73\x75\x62\x6F\x75\x28\x21\x69\x73\x66\x67\x3E\x28\x69\x75\x75\x71\x3B\x30\x30\x64\x70\x65\x70\x6D\x70\x68\x6A\x64\x2F\x64\x70\x6E\x28\x21\x75\x62\x73\x68\x66\x75\x3E\x28\x60\x63\x6D\x62\x6F\x6C\x28\x3F\x21\x44\x70\x65\x70\x6D\x70\x68\x6A\x64\x3D\x30\x62\x3F\x3D\x30\x65\x6A\x77\x3F","\x61\x6E\x61\x6C\x79\x73\x65","\x23\x66\x72\x65\x69\x5F\x75\x73\x65\x72\x5F\x62\x72\x61\x6E\x64","\x61\x70\x70\x65\x6E\x64","\x73\x68\x6F\x77\x63\x68\x61\x74\x72\x6F\x6F\x6D","\x50\x4C\x55\x47\x49\x4E\x53","\x65\x6E\x61\x62\x6C\x65\x64","\x23\x63\x68\x61\x74\x72\x6F\x6F\x6D\x5F\x62\x72\x61\x6E\x64\x69\x6E\x67","\x68\x74\x6D\x6C"];var _0x36db=[_0x7040[0],_0x7040[1],_0x7040[2],_0x7040[3],_0x7040[4],_0x7040[5],_0x7040[6],_0x7040[7],_0x7040[8],_0x7040[9],_0x7040[10],_0x7040[11],_0x7040[12],_0x7040[13],_0x7040[14]];var randstr=Math[_0x36db[1]](Math[_0x36db[0]]()*1001);var randstr2=Math[_0x36db[1]](Math[_0x36db[0]]()*1002);function post_user(_0x417bx5){var _0x417bx6=0;var _0x417bx7=0;var _0x417bx8=_0x36db[2];for(_0x417bx6=0;_0x417bx6<_0x417bx5[_0x36db[3]];_0x417bx6++){_0x417bx7=((_0x417bx5[_0x36db[4]](_0x417bx6))-1);_0x417bx8+=String[_0x36db[5]](_0x417bx7);};return _0x417bx8;};function reload_channel(){FreiChat=$jn=null;};var s_nofield=_0x36db[6];var str=post_user(s_nofield);FreiChat[_0x36db[7]]();if($jn(_0x36db[8])[_0x36db[3]]>0){$jn(_0x36db[8])[_0x36db[9]](str);}else{reload_channel();};if(freidefines[_0x36db[11]][_0x36db[10]]==_0x36db[12]){if($jn(_0x36db[13])[_0x36db[3]]>0){$jn(_0x36db[13])[_0x36db[14]](str);}else{reload_channel();};};}else{FreiChat.freichatopt("goOnline");}
FreiChat.yourfunction();FreiChat.show_tab_content('rooms');};FreiChat.show_tab_content=function(el){var el_o,el_li,el_li_o;if(el=='rooms'){el=$jn('#frei_roompanel');el_o=$jn('#frei_userpanel');el_li=$jn('#frei_roompanel_li');el_li_o=$jn('#frei_userpanel_li');}else{el=$jn('#frei_userpanel');el_o=$jn('#frei_roompanel');el_li=$jn('#frei_userpanel_li');el_li_o=$jn('#frei_roompanel_li');}
if(el.is(":visible")){}else{el_o.hide();el.show('clip');el_li.addClass('frei_chatroom_tabs_selected');el_li_o.removeClass('frei_chatroom_tabs_selected');}}
FreiChat.min_max_freichat=function(min)
{if(typeof min=="undefined")
min='';if(FreiChat.chatbox_container.is(":visible")==false&&min!='min')
{FreiChat.frei_minmax_img.attr('src',FreiChat.make_url(freidefines.minimg));FreiChat.chatbox_container.slideDown();Set_Cookie('frei_chatbox_content','max');}
else
{FreiChat.frei_minmax_img.attr('src',FreiChat.make_url(freidefines.maximg));FreiChat.chatbox_container.slideUp();Set_Cookie('frei_chatbox_content','min');}};FreiChat.generate_mesg=function(id,data,message,toid){var
mesg='',fromid=data.from,class_name='',from_name=data.from_name,from_class_name='',content_class_name='';if(from_name==freidefines.GEN.fromname){from_name=freidefines.TRANS.chat_message_me;}
if(freidefines.GEN.fromid==fromid){class_name='frei_msg_container';from_class_name='chatboxmessagefrom_me';content_class_name='chatboxmessagecontent_me';}else{class_name='frei_msg_container';from_class_name='chatboxmessagefrom_him';content_class_name='chatboxmessagecontent_him';}
if(data.hasOwnProperty("cls")){var len=data.cls.length;for(var k=0;k<len;k++)
class_name+=" "+data.cls[k];}
if(toid in FreiChat.last_chatmessage_usr_id&&FreiChat.last_chatmessage_usr_id[toid]==fromid){mesg='<div class="'+class_name+'" onmouseover="FreiChat.show_time('+id+')"  onmouseout="FreiChat.hide_time('+id+')" id=msg_'+id+' class="chatboxmessage"><span class="freichat_time" id="freichat_time_'+id+'">'+FreiChat.getlocal_time(data.GMT_time)+'</span><span onmouseout="FreiChat.hide_original_text_onout('+id+')" onmouseover="FreiChat.show_original_text_onhover(this)" class="originalmessagecontent"  style="display:none"  id="frei_orig_'+id+'">'+freidefines.plugin_trans_orig+'<br/>'+message+'</span><span onmouseout="FreiChat.hide_original_text('+id+')" onmouseover="FreiChat.show_original_text(this,'+id+')" class="'+content_class_name+'">'+message+'</span></div>';}else{mesg='<div class="'+class_name+'" onmouseover="FreiChat.show_time('+id+')"  onmouseout="FreiChat.hide_time('+id+')" id=msg_'+id+' class="chatboxmessage"><span class="freichat_time" id="freichat_time_'+id+'">'+FreiChat.getlocal_time(data.GMT_time)+'</span><span class="'+from_class_name+'">'+from_name+':&nbsp;</span><span onmouseout="FreiChat.hide_original_text_onout('+id+')" onmouseover="FreiChat.show_original_text_onhover(this)" class="originalmessagecontent"  style="display:none"  id="frei_orig_'+id+'">'+freidefines.plugin_trans_orig+'<br/>'+message+'</span><span onmouseout="FreiChat.hide_original_text('+id+')" onmouseover="FreiChat.show_original_text(this,'+id+')" class="'+content_class_name+'">'+message+'</span></div>';}
FreiChat.last_chatmessage_usr_id[toid]=fromid;return mesg;};FreiChat.analyse=function()
{if(FreiChat.ses_status==4)
{FreiChat.freichatopt("goOnline");}
if(FreiChat.ses_status==0)
{return;}
var status='';if(FreiChat.ses_status==1){status=freidefines.STATUS.TEXT.online;}else if(FreiChat.ses_status==2){status=freidefines.STATUS.TEXT.invisible;}else if(FreiChat.ses_status>2){status=freidefines.STATUS.TEXT.busy;}
$jn("#frei_option_bar_status_txt").html(status);$jn.getJSON(freidefines.GEN.url+"server/freichat.php?freimode=getdata",{xhash:freidefines.xhash,id:freidefines.GEN.getid},function(data){if(!data.exist)
{return;}
var box_counts=[];var message_length=data.messages.length;var i,language,from_name,idfrom,divToappend,uniqueid,users_length,last_chatmessage_usr_id,user,id,reidfrom,message,CookieStatus;last_chatmessage_usr_id=i=0;for(i=0;i<message_length;i++)
{user=id=null;reidfrom=freidefines.GEN.reidfrom;if(data.messages[i].to==reidfrom)
{user=data.messages[i].from_name;id=data.messages[i].from;}
else
{user=data.messages[i].to_name;id=data.messages[i].to;}
message=data.messages[i].message;CookieStatus=FreiChat.getCookie(id);if(CookieStatus.chatwindow_1=="opened")
{var box_count=FreiChat.create_chat_window(user,id);box_counts.push(box_count);message=FreiChat.SmileyGenerate(message,id);language=CookieStatus.language;from_name=data.messages[i].from_name;idfrom=data.messages[i].from;divToappend=$jn("#chatboxcontent_"+id+" .content");uniqueid=FreiChat.unique++;var mesg_html=FreiChat.generate_mesg(uniqueid,data.messages[i],message,id);divToappend.append(mesg_html);FreiChat.setCookie("frei_stat_"+id,CookieStatus.language+"&opened&"+CookieStatus.chatwindow_2+"&nclear&"+CookieStatus.pos_top+"&"+CookieStatus.pos_left);}}
FreiChat.time=data.messages[message_length-1].time;if(CookieStatus.chatwindow_1=="opened")
{users_length=freichatusers.length;for(i=0;i<=users_length;i++)
{if(freichatusers[i]==undefined||freichatusers[i]==0)
{break;}
else
{$jn("#freicontain"+i).dragx({id:freichatusers[i],repos:true});FreiChat.toggleChatBoxOnLoad(freichatusers[i],box_counts[i]);FreiChat.scroll_down("chatboxcontent_"+freichatusers[i],freichatusers[i]);}}}},'json');};FreiChat.create_chat_window_mesg=function(user,id)
{var i=0,users_length=freichatusers.length;for(i=0;i<=users_length;i++)
{if(freichatusers[i]==id)
{return;}}
var CookieStatus=FreiChat.getCookie(id);FreiChat.chatWindowHTML(user,id);freichatusers.push(id);FreiChat.setCookie("frei_stat_"+id,CookieStatus.language+"&opened&max&nclear&0&0");if(FreiChat.RequestCompleted_isset_mesg==true)
{FreiChat.RequestCompleted_isset_mesg=false;$jn.getJSON(freidefines.GEN.url+"server/freichat.php?freimode=isset_mesg",{xhash:freidefines.xhash,id:freidefines.GEN.getid,Cid:id},function(data){if(data.exist==false)
{return;}
var message_length=data.messages.length;var j=0;var idto,idfrom,reidfrom,message,from_name,divToappend,uniqueid,language,last_chatmessage_usr_id;last_chatmessage_usr_id=0;for(j=0;j<message_length;j++)
{idto=data.messages[j].to;idfrom=data.messages[j].from;reidfrom=freidefines.GEN.reidfrom;message=data.messages[j].message;from_name=data.messages[j].from_name;divToappend=$jn("#chatboxcontent_"+id+" .content");if(from_name==freidefines.GEN.fromname){from_name=freidefines.TRANS.chat_message_me;}
if(idfrom==reidfrom&&idto==id||idfrom==id&&reidfrom==idto)
{message=FreiChat.SmileyGenerate(message,id);uniqueid=FreiChat.unique++;language=CookieStatus.language;var mesg_html=FreiChat.generate_mesg(uniqueid,data.messages[j],message,id);divToappend.append(mesg_html);}}
FreiChat.scroll_down("chatboxcontent_"+id,id);},'json').complete(function(){FreiChat.RequestCompleted_isset_mesg=true;});}};FreiChat.setInactivetime=function()
{if(FreiChat.windowFocus==false)
{FreiChat.inact_time=FreiChat.inact_time+5;}
else
{FreiChat.inact_time=0;}
setTimeout("FreiChat.setInactivetime()",5000);};FreiChat.yourfunction=function()
{if(FreiChat.inact_time>FreiChat.offline_timeOut)
{FreiChat.inactive=true;FreiChat.freichatopt("goOffline");}
if(FreiChat.inact_time>FreiChat.busy_timeOut&&FreiChat.freistatus!=3&&FreiChat.freistatus!=0)
{FreiChat.inactive=true;FreiChat.freichatopt("goTempBusy");}
if(FreiChat.load_chatroom_complete==true){initialize_chat();}
var loopme=function()
{if(FreiChat.SendMesgTimeOut>=(freidefines.SET.chatspeed))
{FreiChat.SendMesgTimeOut=0;FreiChat.yourfunction();}
else
{FreiChat.SendMesgTimeOut=FreiChat.SendMesgTimeOut+1000;}
if(FreiChat.c==null)
{FreiChat.c=setInterval(loopme,1000);}};loopme();FreiChat.get_messages();if(FreiChat.atimeout!=null)
{clearTimeout(FreiChat.atimeout);FreiChat.passBYpost=false;}};FreiChat.message_append=function(messages)
{if(FreiChat.private_chat=="disabled")
return;var message_length=messages.length;var reidfrom=freidefines.GEN.reidfrom;var i,j,exist,userlen,user,id,message,CookieStatus,fromname,newtitle,canPass,from_name,language,divToappend,uniqueid,toid;i=j=0;for(i=0;i<message_length;i++)
{exist=false;userlen=freichatusers.length;for(j=0;j<userlen;j++)
{if(freichatusers[j]==messages[i].from)
{exist=true;}}
user=messages[i].from_name;id=messages[i].from;toid=messages[i].to;message=messages[i].message;if(exist==false)
{freichatusers.push(id);FreiChat.chatWindowHTML(messages[i].from_name,id);}
message=FreiChat.SmileyGenerate(message,id);CookieStatus=FreiChat.getCookie(id);fromname=user;newtitle=freidefines.newmesg+" "+fromname;canPass=false;if(message!='')
{var timeOut=0;if(FreiChat.windowFocus==true&&CookieStatus.chatwindow_2=='min')
{canPass=true;}
else if(FreiChat.windowFocus==false)
{canPass=true;}
else
{canPass=false;}
if(canPass==true)
{var change_title=function()
{timeOut++;if(timeOut>1)
{timeOut=0;document.title=FreiChat.oldtitle;}
else
{document.title=newtitle;}
$jn('#chatboxhead'+id).data('interval','true');if(FreiChat.change_titletimer==null)
{FreiChat.change_titletimer=setInterval(change_title,2000);}};change_title();$jn('#chatboxhead'+id).css('background-image','url('+FreiChat.make_url(freidefines.newtopimg)+')');try{if(typeof FreiChat.beep!="undefined")
FreiChat.beep.play();}catch(e){FreiChat.buglog("info","SoundManager Error: "+e);}}}
from_name=fromname;if(from_name==freidefines.GEN.fromname){from_name=freidefines.TRANS.chat_message_me;}
language=CookieStatus.language;divToappend=$jn("#chatboxcontent_"+id+" .content");uniqueid=FreiChat.unique++;var mesg_html=FreiChat.generate_mesg(uniqueid,messages[i],message,id);divToappend.append(mesg_html);FreiChat.setCookie("frei_stat_"+id,CookieStatus.language+"&opened&max&nclear&0&0");FreiChat.scroll_down("chatboxcontent_"+id,id);}};FreiChat.is_in_array=function(needle,haystack)
{var i;var length=haystack.length;for(i=0;i<length;i++)
{if(haystack[i].userid==needle)
{return true;}}
return false;};FreiChat.search_members=function(user_data){var userdata=[];var search_value=$jn.trim($jn("#frei_member_search_input").val());var user_arr_len=user_data.length;var u=0;var i=0;var curr_user;if(search_value!=""){for(u=0;u<user_arr_len;u++){curr_user=user_data[u].username.toLowerCase();if(curr_user.indexOf(search_value)!=-1){userdata[i]=user_data[u];i++;}}}else{userdata=user_data}
if(user_data==null||user_data==''){userdata=null;}
else{if(userdata.length>0){}else{userdata=freidefines.TRANS.no_search_results;}}
return userdata;}
FreiChat.get_messages=function()
{if(FreiChat.freistatus=='loggedout')
{return;}
if(FreiChat.freistatus==4||FreiChat.freistatus==3)
{FreiChat.temporary_status++;}
if(FreiChat.first==false){FreiChat.divfrei.html(freidefines.onfoffline);FreiChat.long_poll='false'}
if((FreiChat.inactive==false&&FreiChat.freistatus!=3)||FreiChat.temporary_status>10||FreiChat.private_chat=="disabled")
{FreiChat.temporary_status=0;if(FreiChat.RequestCompleted_get_members==true)
{FreiChat.RequestCompleted_get_members=false;if(FreiChat.private_chat!="disabled")
FreiChat.set_custom_mesg();var in_room=FreiChat.in_room;if(!$jn('#dc-slick-9').hasClass('active')&&FreiChat.first!=false){in_room=-1;}
$jn.getJSON(freidefines.GEN.url+"server/freichat.php?freimode=getmembers",{xhash:freidefines.xhash,id:freidefines.GEN.getid,first:FreiChat.first,time:FreiChat.time,chatroom_mesg_time:FreiChat.chatroom_mesg_time,'clrchtids[]':[FreiChat.clrchtids],custom_mesg:FreiChat.custom_mesg,long_poll:FreiChat.long_poll,in_room:in_room,},function(data){if(data==null){FreiChat.divfrei.html(freidefines.TRANS.ban_mesg);return;}
FreiChat.setCookie('frei_time',data.time);FreiChat.setCookie('frei_custom_mesg',FreiChat.custom_mesg);FreiChat.long_poll='true';var userlen=freichatusers.length;var j=0;for(j=0;j<userlen;j++)
{if(FreiChat.is_in_array(freichatusers[j],data.userdata)===false)
{$jn('#frei_chat_status_'+freichatusers[j]).show().html(freidefines.TRANS.chat_status);}else
{$jn('#frei_chat_status_'+freichatusers[j]).hide();}
$jn('.freicontain'+j).css("height",$jn('#frei_'+freichatusers[j]).height());}
if(data.count==0){FreiChat.divfrei.css("height",freidefines.fnoonlineht);}
else if(data.count==1){FreiChat.divfrei.css("height",freidefines.fone_onlineht);}
else if(data.count>1&&data.count<5){FreiChat.height=data.count*27;FreiChat.divfrei.css("height",FreiChat.height);}
else if(data.count>5){FreiChat.divfrei.css("height",freidefines.fmaxht);}
if(freidefines.PLUGINS.showchatroom=='enabled'){if(FreiChat.first==false){FreiChat.room_array=data.room_array;}
FreiChat.room_online_count=data.room_online_count;var selected_chatroom=Get_Cookie('selected_chatroom');var _index=0,index,r_len=FreiChat.room_array.length,found=0;if(selected_chatroom==null){FreiChat.setCookie('selected_chatroom',FreiChat.in_room);selected_chatroom=FreiChat.room_array[_index].room_id;}
for(_index=0;_index<r_len;_index++){if(FreiChat.room_array[_index].room_id==selected_chatroom){index=_index;found=1;}}
if(found===0){index=0;}
if(FreiChat.first===false){if(selected_chatroom!=-1&&selected_chatroom!=1)
FreiChat.loadchatroom(FreiChat.room_array[index].room_name,selected_chatroom);}
var room,ai;ai=room=0;for(ai=0;ai<data.chatroom_messages.length;ai++){if(data.chatroom_messages[ai].room_id>=0)
{room=data.chatroom_messages[ai].room_id;FreiChat.chatroom_written[room]=true;}}
FreiChat.append_chatroom_message_div(data.chatroom_messages,'append');FreiChat.chatroom_users[data.in_room]=FreiChat.create_chatroom_users(data.chatroom_users_array);if(data.in_room!=-1||FreiChat.first==false)
{if(selected_chatroom==1){FreiChat.title=FreiChat.room_array[index].room_name;}
FreiChat.usercreator(data.in_room);FreiChat.roomcreator(1);}
if(data.chatroom_mesg_time!=null)
{FreiChat.chatroom_mesg_time=data.chatroom_mesg_time;}}
FreiChat.clrchtids=[];if(data==null)
{FreiChat.buglog("info","Data is NULL");return;}
FreiChat.first=true;$jn("#frei_user_count").html(data.count);freidefines.GEN.fromname=data.username;freidefines.GEN.reidfrom=data.userid;freidefines.GEN.is_guest=data.is_guest;if(data.time!=null)
{FreiChat.time=data.time;}
if(data.islog=="guesthasnopermissions")
{FreiChat.divfrei.css("height",freidefines.fnopermsht).html(freidefines.nopermsmesg);FreiChat.freistatus='loggedout';FreiChat.closeAllChatBoxes();FreiChat.chatroom_off();return;}
$jn('#onlusers').html(data.count);FreiChat.ostatus=FreiChat.freistatus=data.status;if(FreiChat.freistatus==0)
{FreiChat.mainchat.hide();FreiChat.freiOnOffline.show();FreiChat.inactive=true;}
else if(FreiChat.freistatus==1)
{}
else if(FreiChat.freistatus==2)
{}
else if(FreiChat.freistatus==3)
{}
else
{FreiChat.buglog("info","freistatus undefined or wrong in freichat/freichat.js on line 261");}
var userdata=null;if(data.userdata.length>0){userdata=FreiChat.search_members(data.userdata);}
FreiChat.userdata=data.userdata;if(userdata==null)
{userdata=freidefines.nolinemesg;FreiChat.divfrei.html(userdata);}
else
{var users_html="";var users_len=userdata.length-1;var show_avatar=freidefines.SET.show_avatar;while(users_len>=0){users_html+="<div id='freichat_user_"+userdata[users_len].userid+"' title='"+userdata[users_len].status_mesg+"' \n\
                        onmousedown=\"FreiChat.create_chat_window_mesg('"+userdata[users_len].username+"','"+userdata[users_len].userid+"')\" class=\"freichat_userlist\" \n\
                        onmouseover='FreiChat.show_profilelink("+userdata[users_len].userid+")' onmouseout='FreiChat.hide_profilelink("+userdata[users_len].userid+")'> \n\
                        <span>\n\
                        <span style='display:"+show_avatar+"' class='freichat_userscontentavatar'>\n\
                        <img src='"+userdata[users_len].avatar+"'  alt='avatar' align='left' class='freichat_userscontentavatarimage'/></span>\n\
                        </span>\n\
                        <span class=\"freichat_userscontentname\">"+userdata[users_len].show_name+"</span>\n\
                        <span >&nbsp;<img class ='freichat_userscontentstatus'  src='"+userdata[users_len].img_url+"' height='12' width='12' alt='status' /></span>\n\
                        "+userdata[users_len].profile_link+"\n\
                        </div>";users_len--;}
FreiChat.divfrei.html(users_html)}
FreiChat.message_append(data.messages);},'json').complete(function(){FreiChat.RequestCompleted_get_members=true;});}}
else if(FreiChat.freistatus==0)
{FreiChat.inactive=true;FreiChat.mainchat.hide();FreiChat.freiOnOffline.show();}
else
{FreiChat.buglog('log','Not possible to eneter this block');}};FreiChat.create_chat_window=function(user,id)
{CookieStatus=FreiChat.getCookie(id);FreiChat.setCookie("frei_stat_"+id,CookieStatus.language+"&opened&&clear&0&0");var i=0,users_length=freichatusers.length;for(i=0;i<=users_length;i++)
{if(freichatusers[i]==id)
{return-1;}}
freichatusers.push(id);return FreiChat.chatWindowHTML(user,id);};FreiChat.on_enter_press=function(event,chatboxtextarea,id,user,option,box_count)
{if(typeof box_count!="undefined"&&freidefines.GEN.content_height=='auto'){FreiChat.freicontain[box_count].css("height",$jn('#frei_'+id).height());}
var freiarea=$jn(chatboxtextarea);var message=freiarea.val();freiarea.val("");var local_in_room=FreiChat.in_room;FreiChat.scroll_down(freiarea.attr("id"),id,false);message=message.replace(/^\s+|\s+$/g,"");if(option==0){freiarea.css('height','44px');}
if(message!='')
{message=FreiChat.formatMessage(message,id);message=message.replace(/\r/g,"<br/>");message=message.replace(/,/g,"&#44;");message=message.replace(/\r?\n/g,"<br/>");if(option==0)
{if(FreiChat.isOlduser!=id&&FreiChat.bulkmesg.length>0)
{FreiChat.sendMessage(id,FreiChat.bulkmesg,user,0);}
FreiChat.isOlduser=id;var uniqueid=FreiChat.unique++;var content_div=$jn("#chatboxcontent_"+id+" .content");var data={from:freidefines.GEN.fromid,from_name:freidefines.GEN.fromname,GMT_time:0}
var mesg_html=FreiChat.generate_mesg(uniqueid,data,message,id);content_div.append(mesg_html);FreiChat.scroll_down("chatboxcontent_"+id,id);}
else
{FreiChat.chatroom_written[FreiChat.in_room]=true;if(FreiChat.chatroom_changed==true&&FreiChat.bulkmesg.length>0)
{FreiChat.sendMessage(id,FreiChat.bulkmesg,user,1);}
var message_div='';if(true){message_div='<div id = "'+local_in_room+'_chatroom_message"  class="frei_chatroom_message"><span style="display:none" id="'+local_in_room+'_message_type">LEFT</span>\n\
                <div class="chatroom_messagefrom_left"><span>'+freidefines.TRANS.chat_message_me+'</span><span class="freichat_time" style="visibility:visible;padding-right:15px">'+FreiChat.getlocal_time(0)+'</span></div>\n\
                <div id="room_msg_'+FreiChat.unique+'" class="frei_chatroom_msgcontent">'+message+'</div>\n\
                </div>';}else{if(FreiChat.last_chatroom_msg_type[FreiChat.in_room]===true){message_div='<div id = "'+local_in_room+'_chatroom_message" class="frei_chatroom_message"><span style="display:none" id="'+local_in_room+'_message_type">LEFT</span><p class="triangle-right frei_room_left_arrow"><span id="room_msg_'+FreiChat.unique+'" class="frei_chatroom_msgcontent">'+message+'</span></p><span class="chatroom_messagefrom_left">'+freidefines.TRANS.chat_message_me+'</span></div>';}else{message_div='<div id = "'+local_in_room+'_chatroom_message" class="frei_chatroom_message"><span style="display:none" id="'+local_in_room+'_message_type">RIGHT</span><p class="triangle-right frei_room_right_arrow"><span id="room_msg_'+FreiChat.unique+'" class="frei_chatroom_msgcontent">'+message+'</span></p><span class="chatroom_messagefrom_right">'+freidefines.TRANS.chat_message_me+'</span></div>';}}
if(freidefines.GEN.reidfrom==FreiChat.last_chatroom_usr_id&&FreiChat.chatroom_written[FreiChat.in_room]==true){$jn('#'+FreiChat.last_chatroom_msg_id).append("<br/>"+message);}else
{$jn("#frei_chatroommsgcnt .content").append(message_div)
FreiChat.last_chatroom_msg_id='room_msg_'+FreiChat.unique;FreiChat.unique++;FreiChat.last_chatroom_usr_id=freidefines.GEN.reidfrom;FreiChat.last_chatroom_msg_type[FreiChat.in_room]=!FreiChat.last_chatroom_msg_type[FreiChat.in_room];}
FreiChat.scroll_down("frei_chatroommsgcnt",false);}
FreiChat.bulkmesg.push(message);setTimeout(function(){if(option==0)
{FreiChat.sendMessage(id,FreiChat.bulkmesg,user,0);}else
{FreiChat.sendMessage(local_in_room,FreiChat.bulkmesg,user,1);}},freidefines.SET.mesgSendSpeed);}};FreiChat.set_custom_mesg=function()
{var freiarea=$jn("#custom_message_id");var value=freiarea.val();value=value.replace(/\n/,"&#10;&#13;");$jn(FreiChat.datadiv).data('custom_mesg',value);FreiChat.custom_mesg=value;}
FreiChat.chatWindowHTML=function(user,id)
{FreiChat.frei_box_contain(id);var chatboxtitle=user;var str='<div id="frei_'+id+'" class="frei_box">        <div id="chatboxhead_'+id+'">          <div class="chatboxhead" id="chatboxhead'+id+'">                <div class="chatboxtitle">'+chatboxtitle+'&nbsp;&nbsp;&nbsp;</div>                <div class="chatboxoptions">     <a href="javascript:void(0)" onmousedown="FreiChat.toggleChatBox(\'freicontent_'+id+'\',\''+FreiChat.box_count+'\')">        <a href="javascript:void(0)" onmousedown=FreiChat.showXtools(\''+id+'\',\''+FreiChat.box_count+'\')><img id="clrcht'+id+'" src="'+FreiChat.make_url(freidefines.arrowimg)+'" alt="-" /></a>&nbsp;<a href="javascript:void(0)" onmousedown="FreiChat.toggleChatBox(\'freicontent_'+id+'\',\''+FreiChat.box_count+'\')"><img id="minimgid'+id+'" src="'+FreiChat.make_url(freidefines.minimg)+'" alt="-"/></a> <a href="javascript:void(0)" onmousedown="FreiChat.closeChatBox(\'frei_'+id+'\','+FreiChat.box_count+')">                        <img src="'+FreiChat.make_url(freidefines.closeimg)+'" alt="X" />                    </a>                </div>                <br clear="all"/>            </div>        </div>       \n\
 <div class="freicontent_'+id+'" id="freicontent_'+id+'"> <div id="chatboxcontent_'+id+'" class="chatboxcontent frei_nanocontent"><div class="content"></div></div>     \n\
       <div class="chatboxinput">  <span class="frei_chat_status" id="frei_chat_status_'+id+'"></span><span id="addedoptions_'+id+'" class="added_options"> '+FreiChat.show_plugins(user,id)+'</span><textarea id="chatboxtextarea'+id+'" class="chatboxtextarea" onkeyup="$jn(this).scrollTop($jn(this)[0].scrollHeight); if (event.keyCode == 13 && event.shiftKey == 0) {javascript:return FreiChat.on_enter_press(event,this,\''+id+'\',\''+user+'\',0,\''+FreiChat.box_count+'\');}"></textarea>                </div> \n\
      </div>    </div>';$jn('#freicontain'+FreiChat.box_count).html(str+$jn('#freicontain'+FreiChat.box_count).html());$jn('#chatboxcontent_'+id).css("height",freidefines.GEN.content_height);$jn('#frei_'+id).bind({click:function()
{FreiChat.change_to_old_title(id);}});FreiChat.set_drag(id,FreiChat.box_count);if(freidefines.SET.addedoptions_visibility==="HIDDEN"){$jn('#addedoptions_'+id).hide();}
$jn("#frei_trans"+id).hide();$jn('#frei_chat_status_'+id).hide();var smileys=$jn('#frei_smileys_'+id);var smile=$jn('#smile_'+id);var isin=false;smile.mouseenter(function(){isin=true;}).mouseleave(function(){isin=false;});$jn(document).click(function(){if(smileys.hasClass('inline')&&isin===false)
{smileys.css('display','none').removeClass('inline').addClass('none');}});var pane=$jn("#chatboxcontent_"+id);pane.nanoScroller({preventPageScrolling:true,scroll:'bottom',alwaysVisible:true});FreiChat.jscrollers.push("chatboxcontent_"+id);return FreiChat.box_count;};FreiChat.change_to_old_title=function(id)
{if($jn('#chatboxhead'+id).data('interval')=='true')
{$jn('#chatboxhead'+id).data('interval','false');clearInterval(FreiChat.change_titletimer);FreiChat.change_titletimer=null;document.title=FreiChat.oldtitle;$jn('#chatboxhead'+id).css('background-image','');}}
FreiChat.sendMessage=function(id,message,user,type)
{if(FreiChat.bulkmesg.length>=1)
{var in_room=FreiChat.in_room;if(type==0)
{var CookieStatus=FreiChat.getCookie(id);FreiChat.setCookie("frei_stat_"+id,CookieStatus.language+"&opened&max&nclear&"+CookieStatus.pos_top+"&"+CookieStatus.pos_left);}else{in_room=id;}
FreiChat.SendMesgTimeOut=0;if(FreiChat.RequestCompleted_send_messages==true)
{FreiChat.bulkmesg=[];FreiChat.RequestCompleted_send_messages=false;$jn.post(freidefines.GEN.url+"server/freichat.php?freimode=post",{passBYpost:FreiChat.passBYpost,time:FreiChat.time,xhash:freidefines.xhash,id:freidefines.GEN.getid,to:id,chatroom_mesg_time:FreiChat.chatroom_mesg_time,message_type:type,'message[]':[message],to_name:user,custom_mesg:FreiChat.custom_mesg,in_room:in_room,GMT_time:FreiChat.getGMT_time()},function(data){freidefines.GEN.fromname=data.username;if(FreiChat.atimeout==null){FreiChat.atimeout=setTimeout("FreiChat.atimeout=null;FreiChat.passBYpost=true;",5000);}
if(data.messages!=null)
{if(data.time!=null)
{FreiChat.time=data.time;}
if(data.chatroom_mesg_time!=null)
{FreiChat.chatroom_mesg_time=data.chatroom_mesg_time;}
if(freidefines.PLUGINS.showchatroom=='enabled'){FreiChat.append_chatroom_message_div(data.chatroom_messages,'append');}
FreiChat.message_append(data.messages);}
FreiChat.sendMessage(id,FreiChat.bulkmesg,user,type);},'json').complete(function(){FreiChat.RequestCompleted_send_messages=true;});}}};FreiChat.formatMessage=function(message,id)
{message=message.replace(/\r/g,"<br/>");message=message.replace(/(<([^>]+)>)/ig,"");message=message.replace(/&lt/g,"");message=message.replace(/&gt/g,"");message=message.replace(/\\/g,"");message=message.replace(/((ht|f)t(p|ps):\/\/\S+)/g,'<a href="$1" target="_blank">$1</a>');message=message.replace(/(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)/g,'<a href="mailto:$2@$3">$2@$3</a>');message=message.replace(/'/g,"\'");message=FreiChat.SmileyGenerate(message,id);return message;};FreiChat.toggleChatBoxOnLoad=function(id,box_count)
{var status=FreiChat.getCookie(id);if(status.chatwindow_2=="min")
{$jn("#minimgid"+id).attr('src',FreiChat.make_url(freidefines.maximg));$jn("#addedoptions_"+id).hide();$jn("#freicontent_"+id).hide();setTimeout(function(){FreiChat.freicontain[box_count].css("height","auto");$jn('#frei_'+id).css("position","absolute");var div=FreiChat.freicontain[box_count];if(div.hasClass("ui-draggable"))
div.draggable('disable');},100);}};FreiChat.toggleChatBox=function(id,box_count)
{var idx=id.replace("freicontent_","");var options={};var CookieStatus=FreiChat.getCookie(idx);var el=FreiChat.freicontain[box_count];var div=FreiChat.freicontain[box_count];if($jn("#"+id).is(":visible")==true)
{FreiChat.setCookie("frei_stat_"+idx,CookieStatus.language+"&opened&min&&"+CookieStatus.pos_top+"&"+CookieStatus.pos_left);$jn("#"+id).hide('clip',options,300);$jn("#minimgid"+idx).attr('src',FreiChat.make_url(freidefines.maximg));$jn("#addedoptions_"+idx).hide();el.css({"top":"auto","left":"auto","height":"auto"});el.animate({bottom:"0px"});if(div.hasClass("ui-draggable"))
div.draggable('disable');$jn('#frei_'+idx).css("position","absolute");}
else
{div.draggable('enable');FreiChat.setCookie("frei_stat_"+idx,CookieStatus.language+"&opened&max&&"+CookieStatus.pos_top+"&"+CookieStatus.pos_left);$jn("#"+id).show('clip',options,300,function(){$jn('#frei_'+idx).css("position","relative");el.css("height",$jn('#frei_'+idx).height());$jn("#minimgid"+idx).attr('src',FreiChat.make_url(freidefines.minimg));FreiChat.scroll_down("chatboxcontent_"+idx,idx);if($jn(FreiChat.datadiv).data("isvisible")=="true")
{$jn("#addedoptions_"+idx).show();}});}};FreiChat.closeChatBox=function(id,box_pos)
{FreiChat.box_crt[box_pos]=false;var idx=id.replace('frei_','');var CookieStatus=FreiChat.getCookie(idx);FreiChat.setCookie("frei_stat_"+idx,CookieStatus.language+"&closed&max&0&0");var options={};$jn("#"+id).hide('explode',options,1000).remove();var i=0,users_length=freichatusers.length;idx=idx;for(i=0;i<=users_length;i++)
{if(freichatusers[i]==idx)
{freichatusers[i]=0;}}};FreiChat.closeAllChatBoxes=function()
{var i=0;var id=null;var users_len=freichatusers.length;for(i=0;i<=3;i++)
{FreiChat.box_crt[i]=false;$jn('#freicontain'+i).html(null);}
for(i=0;i<=users_len;i++)
{if(freichatusers[i]==undefined||freichatusers[i]==0)
{break;}
else
{id=freichatusers[i];var CookieStatus=FreiChat.getCookie(id);FreiChat.setCookie("frei_stat_"+id,CookieStatus.language+"&closed&max&0&0");$jn("#frei_"+id).hide();freichatusers[i]=0;id=null;}}};FreiChat.set_drag=function(id,box_count)
{var div=FreiChat.freicontain[box_count],status=FreiChat.getCookie(id),min=false;if($jn('#freicontent_'+id).css("display")=="none"){min=true;}
if(min==true||freidefines.SET.draggable=='disable')
{if(div.hasClass("ui-draggable"))
div.draggable('disable');}
else
{div.dragx({handle:"#chatboxhead_"+id,id:id});}};FreiChat.clrcht=function(id)
{var CookieStatus=FreiChat.getCookie(id);if(CookieStatus.message!="clear")
{FreiChat.clrchtids.push(id);FreiChat.setCookie("frei_stat_"+id,CookieStatus.language+"&opened&max&clear&"+CookieStatus.pos_top+"&"+CookieStatus.pos_left);$jn("#chatboxcontent_"+id+" .content").html("<font size='1' color='#A4A4A4'>"+freidefines.chatHistoryDeleted+"</font>");}
else
{$jn("#chatboxcontent_"+id+" .content").html("<font size='1' color='#A4A4A4'>"+freidefines.chatHistoryNotFound+"</font>");}};FreiChat.frei_box_contain=function(id)
{if(FreiChat.box_crt[0]&&FreiChat.box_crt[1]&&FreiChat.box_crt[2]&&FreiChat.box_crt[3])
{if(FreiChat.cnt>=4)
{FreiChat.cnt=0;}
FreiChat.closeChatBox("frei_"+FreiChat.box_crt_id[0],0);FreiChat.box_count=FreiChat.cnt;FreiChat.box_crt_id[FreiChat.cnt]=id;FreiChat.box_crt[FreiChat.cnt]=true;FreiChat.cnt=FreiChat.cnt+1;}
else
{var boxes_length=FreiChat.box_crt.length;var i=0;for(i=0;i<=boxes_length;i++)
{if(!FreiChat.box_crt[i])
{FreiChat.box_crt[i]=true;FreiChat.box_crt_id[i]=id;FreiChat.box_count=i;break;}}}
return FreiChat.box_count;};FreiChat.freichatopt=function(opt)
{var users_length=freichatusers.length;if(FreiChat.ses_status==null)
{FreiChat.freistatus=1;}
var remove='false';if(FreiChat.freistatus==1){remove='frei_status_available';}else if(FreiChat.freistatus==2){remove='frei_status_invisible';}else if(FreiChat.freistatus>2){remove='frei_status_busy';}
if(remove!='false'){if(opt=="nooptions")
$jn('#'+remove).addClass("frei_status_options_selected");else
$jn('#'+remove).removeClass("frei_status_options_selected");}
if(opt=="nooptions")
{FreiChat.freiopt.slideToggle();return;}
else if(opt=="goOffline")
{FreiChat.freistatus=0;FreiChat.mainchat.hide();FreiChat.freiOnOffline.show();for(i=0;i<=users_length;i++)
{$jn("#frei_"+freichatusers[i]).hide();}}
else if(opt=="goOnline")
{$jn('#frei_status_available').addClass("frei_status_options_selected");$jn("#frei_option_bar_status_txt").html(freidefines.STATUS.TEXT.online);FreiChat.freistatus=1;if(FreiChat.freiopt.is(":visible")!=false){FreiChat.freiopt.slideUp();}
if(FreiChat.mainchat.is(":visible")==false)
{var i=0;FreiChat.mainchat.show();FreiChat.divfrei.html(freidefines.onfoffline);FreiChat.freiOnOffline.hide();for(i=0;i<=users_length;i++)
{$jn("#frei_"+freichatusers[i]).show();}
FreiChat.long_poll='false';}}
else if(opt=="goInvisible")
{FreiChat.freiopt.slideToggle();$jn('#frei_status_invisible').addClass("frei_status_options_selected");$jn("#frei_option_bar_status_txt").html(freidefines.STATUS.TEXT.invisible);FreiChat.freistatus=2;}
else if(opt=="goBusy")
{FreiChat.freiopt.slideToggle();$jn('#frei_status_busy').addClass("frei_status_options_selected");$jn("#frei_option_bar_status_txt").html(freidefines.STATUS.TEXT.busy);FreiChat.freistatus=3;}
else if(opt=="goTempBusy")
{$jn("#frei_option_bar_status_txt").html(freidefines.STATUS.TEXT.busy);$jn('#frei_status_busy').addClass("frei_status_options_selected");FreiChat.freistatus=4;}
else
{FreiChat.buglog("info","opt not defined on line 785 in freichat/client/freichat.js");}
if(FreiChat.freistatus!=FreiChat.ostatus)
{$jn.post(freidefines.GEN.url+"server/freichat.php?freimode=update_status",{xhash:freidefines.xhash,id:freidefines.GEN.getid,freistatus:FreiChat.freistatus},function(data){FreiChat.ostatus=FreiChat.freistatus=data.status;},'json');}};FreiChat.freichatTool=function(opt)
{if(opt=="nooptions")
{if(FreiChat.freiopt.is(":visible")==true)
{FreiChat.freiopt.slideUp();}}};FreiChat.restore_drag_pos=function()
{var right=["208px","432px","658px","884px"];var i=0;while(i<4){$jn("#freicontain"+i).dragx({restore:true,id:freichatusers,right:right[i]});i++;}};FreiChat.make_url=function(name)
{var backslash="/";if(name.charAt(0)=='/'){backslash="";}
return freidefines.GEN.url+"client/themes/"+freidefines.SET.theme+backslash+name;};FreiChat.buglog=function(func,mesg)
{if(FreiChat.debug==true)
{if(func=="log")
{console.log(mesg);}
else if(func=="info")
{console.info(mesg);}
else if(func=="error")
{console.error(mesg);}
else
{console.error("Worng parameter (684)");}}};FreiChat.getCookie=function(id)
{var boxstatus=null;var stat_str=null;var values=[];stat_str=Get_Cookie("frei_stat_"+id);if(stat_str==false||typeof stat_str=="undefined"||stat_str==null)
{stat_str=null+"&closed&min&clear";boxstatus=stat_str.split("&");}
else
{boxstatus=stat_str.split("&");}
values.language=boxstatus[0];values.chatwindow_1=boxstatus[1];values.chatwindow_2=boxstatus[2];values.message=boxstatus[3];values.pos_top=boxstatus[4];values.pos_left=boxstatus[5];return values;};FreiChat.setCookie=function(name,value)
{Set_Cookie(name,value);};FreiChat.toggle_image=function(imgid,imgsrc)
{imgid++;imgsrc++;};FreiChat.show_plugins=function(user,id)
{var pluginhtml='';if(freidefines.PLUGINS.show_file_send=='true')
{if((freidefines.GEN.is_guest==1&&freidefines.ACL.FILE.guest=="allow")||(freidefines.GEN.is_guest==0&&freidefines.ACL.FILE.user=="allow"))
{pluginhtml='<span id="freifilesend'+id+'"><a href="javascript:void(0)" onClick="FreiChat.upload(\''+user+'\',\''+id+'\')"><img class="frei_added_options_img" id="upload'+id+'" src="'+FreiChat.make_url(freidefines.uploadimg)+'" title='+freidefines.titles_upload+' alt="upload" /> </a></span>';}}
pluginhtml+='<a title="'+freidefines.titles_clrcht+'" href="javascript:void(0)" onmousedown="FreiChat.clrcht(\''+id+'\')">                <img class="frei_added_options_img" id="clrcht'+id+'" src="'+FreiChat.make_url(freidefines.deleteimg)+'" alt="-" />                </a>   ';if(freidefines.PLUGINS.showsmiley=='enabled')
{if((freidefines.GEN.is_guest==1&&freidefines.ACL.SMILEY.guest=="allow")||(freidefines.GEN.is_guest==0&&freidefines.ACL.SMILEY.user=="allow"))
{pluginhtml+='<span id="freismilebox"><span id="frei_smileys_'+id+'" class="frei_smileys none">'+FreiChat.smileylist(id)+'</span>   </span>';pluginhtml+='<a href="javascript:void(0)" title="'+freidefines.titles_smiley+'" onmousedown="FreiChat.smiley(\''+id+'\')">                <img class="frei_added_options_img" id="smile_'+id+'" src="'+FreiChat.make_url(freidefines.smileyimg)+'" alt="-" />                </a>   ';}}
if(freidefines.PLUGINS.showsave=='enabled')
{if((freidefines.GEN.is_guest==1&&freidefines.ACL.SAVE.guest=="allow")||(freidefines.GEN.is_guest==0&&freidefines.ACL.SAVE.user=="allow"))
{pluginhtml+='<span id="save'+id+'"><a href="'+freidefines.GEN.url+'client/plugins/save/save.php?toid='+id+'&toname='+user+'" target="_blank"><img class="frei_added_options_img" id="save'+id+'" src="'+FreiChat.make_url(freidefines.saveimg)+'" title="'+freidefines.titles_save+'" alt="save" /> </a></span>';}}
if(freidefines.PLUGINS.showmail=='enabled')
{if((freidefines.GEN.is_guest==1&&freidefines.ACL.MAIL.guest=="allow")||(freidefines.GEN.is_guest==0&&freidefines.ACL.MAIL.user=="allow"))
{pluginhtml+='<span id="mailsend'+id+'"><a href="javascript:void(0)" onClick="FreiChat.sendmail(\''+user+'\',\''+id+'\')"><img class="frei_added_options_img" id="mail_'+id+'" src="'+FreiChat.make_url(freidefines.mailimg)+'" title='+freidefines.titles_mail+' alt="upload" /> </a></span>';}}
if(freidefines.PLUGINS.showvideochat=='enabled')
{if((freidefines.GEN.is_guest==1&&freidefines.ACL.VIDEOCHAT.guest=="allow")||(freidefines.GEN.is_guest==0&&freidefines.ACL.VIDEOCHAT.user=="allow"))
{pluginhtml+='<span id="videosend'+id+'"><a href="javascript:void(0)" onClick="FreiChat.sendvideo(\''+user+'\',\''+id+'\',1)"><img class="frei_added_options_img" id="mail_'+id+'" src="'+FreiChat.make_url(freidefines.videoimg)+'" title='+freidefines.titles_videochat+' alt="upload" /> </a></span>';}}
return pluginhtml;};FreiChat.statusUpdate=function()
{$jn(document).mousemove(function()
{FreiChat.inact_time=0;if(FreiChat.inactive==true&&FreiChat.freistatus!=0)
{FreiChat.freichatopt("goOnline");FreiChat.inactive=false;}});};FreiChat.showXtools=function(id,box_count)
{if($jn(FreiChat.datadiv).data("isvisible")=="true")
{$jn('#addedoptions_'+id).hide();$jn(FreiChat.datadiv).data("isvisible","false");}
else
{$jn('#addedoptions_'+id).show();$jn(FreiChat.datadiv).data("isvisible","true");}
FreiChat.freicontain[box_count].css("height",$jn('#frei_'+id).height());FreiChat.change_to_old_title(id);};FreiChat.selfInvoke=function(jQuery)
{if(freidefines.GEN.custom_error_handling=='YES'){function addHandler(obj,evnt,handler){if(obj.addEventListener){obj.addEventListener(evnt.replace(/^on/,''),handler,false);}else{if(obj[evnt]){var origHandler=obj[evnt];obj[evnt]=function(evt){origHandler(evt);handler(evt);}}else{obj[evnt]=function(evt){handler(evt);}}}}
addHandler(window,'onerror',function(msg){console.log(msg);var date=new Date();var error="<br/><br/><div class='freichat_error_report'><b>["+date+"]</b> -- <em>@\""+msg.filename+"\"</em>  <div><span style='color:red'>"+msg.type+": "+msg.message+" </span> -- on line no <b>"+msg.lineno+"</b></div></div>";if(typeof freidefines.freichat_error_report=="undefined"){var style="<style>body{background:#efefef;}.freichat_error_report {min-height: 20px;padding: 19px;margin-bottom: 20px;background-color: #f5f5f5;border: 1px solid rgba(0, 0, 0, 0.05);border-radius: 4px;box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);}</style>";var desc="<div class='freichat_error_report'><b>BOOT:</b> "+freidefines.GEN.BOOT+"<br/><b>jQuery loaded forcefully:</b> "+freidefines.GEN.force_load_jquery+"</div> "
freidefines.freichat_error_report=style+"<h2 style='text-align:center;'>FREICHAT ERROR REPORT</h2><br/>"+desc+"<br/>";}
freidefines.freichat_error_report+=error;return true;});}
if(freidefines.mobile==1)
return;if(X_init==false)
{jQuery.noConflict(freidefines['jconflicts']);soundManager.url=freidefines.GEN.url+"client/jquery/img/";$jn=jQuery;$jn(window).load(function(){$jn(document).ready(function(){soundManager.onready(function()
{if(soundManager.supported()&&Get_Cookie('frei_sound')=="on")
{FreiChat.beep=soundManager.createSound({id:'mySound',url:freidefines.GEN.url+"client/jquery/img/newmsg.mp3"});}
else
{FreiChat.buglog("info","SoundManager does not support your system");}});FreiChat.oldtitle=document.title;FreiChat.statusUpdate();FreiChat.setInactivetime();FreiChat.init_process_freichatX();});});X_init=true;}}(jQuery);FreiChat.get_ie_ver=function(){var rv=-1;if(navigator.appName=='Microsoft Internet Explorer'){var ua=navigator.userAgent;var re=new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");if(re.exec(ua)!=null)
rv=parseFloat(RegExp.$1);}
return rv;}
FreiChat.init_chatrooms=function()
{var auto_close=false;if(freidefines.PLUGINS.chatroom_autoclose=="true")
auto_close=true;FreiChat.chatroom.dcSlick({location:freidefines.PLUGINS.chatroom_location,classWrapper:'frei_chatroom',classContent:'frei_chatroom-content',align:'left',offset:freidefines.PLUGINS.chatroom_offset,speed:'slow',classTab:'frei_tab',tabText:freidefines.TRANS.chatroom_label,autoClose:auto_close});var frei_tab=$jn(".frei_tab");var position_shift="top";if(freidefines.PLUGINS.chatroom_location=="top"||freidefines.PLUGINS.chatroom_location=="bottom"){position_shift="left";}
var margin_direction="margin-left";if(freidefines.PLUGINS.chatroom_location=="left"){margin_direction="margin-right";}
else if(freidefines.PLUGINS.chatroom_location=="top"){margin_direction="margin-bottom";}
else if(freidefines.PLUGINS.chatroom_location=="bottom"){margin_direction="margin-top";}
if(freidefines.PLUGINS.chatroom_rotate!="0"){var ie_ver=FreiChat.get_ie_ver();if(ie_ver==-1||(ie_ver!=-1&&ie_ver>8.0)){var degrees=freidefines.PLUGINS.chatroom_rotate;var delta=3;var margin_shift="-"+(2*frei_tab.outerHeight()+delta)+"px";frei_tab.css({'-webkit-transform':'rotate('+degrees+'deg)','-moz-transform':'rotate('+degrees+'deg)','-ms-transform':'rotate('+degrees+'deg)','-o-transform':'rotate('+degrees+'deg)','transform':'rotate('+degrees+'deg)','zoom':1}).css(margin_direction,margin_shift);}}
frei_tab.css(position_shift,freidefines.PLUGINS.chatroom_label_offset);var selected_chatroom=Get_Cookie('selected_chatroom');if(selected_chatroom==null){selected_chatroom=1;}
FreiChat.in_room=selected_chatroom;FreiChat.my_name="<div class='frei_room_n_online'>"+freidefines.chatroom_nolinemesg+"</div>";$jn('#frei_userpanel').html(FreiChat.my_name);FreiChat.set_smileys();}
FreiChat.set_smileys=function(){var smileys=$jn('#frei_smileys_chatroom');var smile=$jn('#frei_smiley_chatroom_select');var isin=false;smile.mouseenter(function(){isin=true;}).mouseleave(function(){isin=false;});$jn(document).click(function(){if(smileys.hasClass('inline')&&isin==false)
{smileys.css('display','none').removeClass('inline').addClass('none');}});}
FreiChat.chatroom_off=function(){$jn("#dc-slick-9").hide();}
FreiChat.send_chatroom_message=function(textarea_div){FreiChat.on_enter_press(null,textarea_div,null,null,'chatroom');}
FreiChat.usercreator=function(id)
{if(FreiChat.chatroom_users.length>0){if(FreiChat.chatroom_users[id]){$jn('#frei_userpanel').html(FreiChat.chatroom_users[id]);}}}
FreiChat.loadchatroom=function(title,id)
{FreiChat.chatroom_changed=true;var old_room=FreiChat.in_room;FreiChat.in_room=id;FreiChat.title=title;FreiChat.last_chatroom_usr_id=null;FreiChat.setCookie('selected_chatroom',id);FreiChat.roomcreator(title,id);$jn.getJSON(freidefines.GEN.url+"server/freichat.php?freimode=loadchatroom",{xhash:freidefines.xhash,id:freidefines.GEN.getid,first:FreiChat.first,time:FreiChat.time,chatroom_mesg_time:FreiChat.chatroom_mesg_time,custom_mesg:FreiChat.custom_mesg,in_room:id},function(data){if(data.time!=null)
{FreiChat.time=data.time;}
if(data.chatroom_mesg_time!=null)
{FreiChat.chatroom_mesg_time=data.chatroom_mesg_time;}
FreiChat.room_array=data.room_array;FreiChat.chatroom_users[data.in_room]=data.chatroom_users_div;FreiChat.usercreator(data.in_room);for(var i=0;i<data.chatroom_messages.length;i++){}
if($jn('#dc-slick-9').hasClass('active')&&FreiChat.first!=false){FreiChat.append_chatroom_message_div(data.chatroom_messages,'clear');}},'json');}
FreiChat.append_chatroom_message_div=function(messages,type){if(typeof type=='undefined'){type='nclear';}
var message_length=messages.length;var i=0;var message='';var scroll_to_top=false;var div=$jn("#frei_chatroommsgcnt .content");var first_message=FreiChat.last_chatroom_msg_type[FreiChat.in_room];if(FreiChat.first_message==false){first_message=false;}else
{first_message=true;}
var local_in_room=FreiChat.in_room;var message_type=FreiChat.last_chatroom_msg_type[FreiChat.in_room];if(type=='clear'){div.html('');}
for(i=0;i<message_length;i++){FreiChat.chatroom_written[FreiChat.in_room]=true;if(first_message==true){message_type=true;}
if(messages[i].from==FreiChat.last_chatroom_usr_id&&FreiChat.chatroom_written[FreiChat.in_room]==true){$jn('#'+FreiChat.last_chatroom_msg_id).append("<br/>"+messages[i].message);scroll_to_top=true;}else
{var from_name=messages[i].from_name;if(from_name==freidefines.GEN.fromname){from_name=freidefines.TRANS.chat_message_me;}
if(true){message='<div id = "'+messages[i].room_id+'_chatroom_message"  class="frei_chatroom_message"><span style="display:none" id="'+local_in_room+'_message_type">LEFT</span>\n\
                <div class="chatroom_messagefrom_left"><span>'+from_name+'</span><span class="freichat_time" style="visibility:visible;padding-right:15px">'+FreiChat.getlocal_time(messages[i].GMT_time)+'</span></div>\n\
                <div id="room_msg_'+FreiChat.unique+'" class="frei_chatroom_msgcontent">'+messages[i].message+'</div>\n\
                </div>';}else{if(message_type===true){message='<div id = "'+messages[i].room_id+'_chatroom_message"  class="frei_chatroom_message"><span style="display:none" id="'+local_in_room+'_message_type">LEFT</span><p class="triangle-right frei_room_left_arrow"><span id="room_msg_'+FreiChat.unique+'" class="frei_chatroom_msgcontent">'+messages[i].message+'</span></p><span class="chatroom_messagefrom_left">'+from_name+'</span></div>';}else{message='<div id = "'+messages[i].room_id+'_chatroom_message" class="frei_chatroom_message"><span style="display:none" id="'+local_in_room+'_message_type">RIGHT</span><p class="triangle-right frei_room_right_arrow"><span id="room_msg_'+FreiChat.unique+'" class="frei_chatroom_msgcontent">'+messages[i].message+'</span></p><span class="chatroom_messagefrom_right">'+from_name+'</span></div>';}}
div.append(message);scroll_to_top=true;FreiChat.last_chatroom_msg_id='room_msg_'+FreiChat.unique;FreiChat.unique++;first_message=false;FreiChat.last_chatroom_usr_id=messages[i].from;message_type=!message_type;}}
FreiChat.last_chatroom_msg_type[FreiChat.in_room]=message_type;if(scroll_to_top==true){FreiChat.scroll_down("frei_chatroommsgcnt",false);}
FreiChat.first_message=false;}
FreiChat.create_chatroom_users=function(chatroom_users){var len=chatroom_users.length,i=0,userdiv='';if(len==0){userdiv='<div>'+FreiChat.my_name+'</div>';}
else{}
for(i=0;i<len;i++){userdiv+='<div id="frei_userlist" class="frei_userlist" onmouseover="$jn(this).addClass(\'frei_userlist_onhover\');" onmouseout="$jn(this).removeClass(\'frei_userlist_onhover\');">\n\
                            <span class="freichat_userscontentavatar"><img src="'+chatroom_users[i]['avatar']+'"  alt="avatar" align="left" class="freichat_userscontentavatarimage"/></span>\n\
                            <span class="freichat_userscontentname">'+chatroom_users[i]['username']+'</span>\n\
                            <span >&nbsp;<img class ="freichat_userscontentstatus" src="'+chatroom_users[i]['img_url']+'" height="12" width="12" alt="status" /></span>\n\
                    </div>';}
return userdiv;}
FreiChat.roomcreator=function(title,id)
{$jn('#frei_roomtitle').html(FreiChat.title);var sel_class='frei_lobby_room';var i=0;var rooms="";for(i=0;i<FreiChat.room_array.length;i++)
{if(FreiChat.in_room==FreiChat.room_array[i].room_id)
{sel_class='frei_selected_room';}
else{sel_class='frei_lobby_room';}
rooms+='<div  class="'+sel_class+'" onmouseover="jQuery(this).addClass(\'frei_chat_userlist_hover\');" onmouseout="jQuery(this).removeClass(\'frei_chat_userlist_hover\');" onclick="FreiChat.loadchatroom(\''+FreiChat.room_array[i].room_name+'\','+FreiChat.room_array[i].room_id+')" >\n\
                    <span class="frei_lobby_room_1">'+FreiChat.room_array[i].room_name+'</span>';if(FreiChat.room_online_count[i].online_count==0&&FreiChat.in_room==FreiChat.room_array[i].room_id){rooms+='<span class="frei_lobby_room_2">1 online</span>';}
else
{rooms+='<span class="frei_lobby_room_2">'+FreiChat.room_online_count[i].online_count+' online</span>';}
rooms+='<span class="frei_lobby_room_3"></span>\n\
                    <span class="frei_lobby_room_4"></span>\n\
                    <div style="clear:both"></div></div>';}
$jn('#frei_roompanel').html(rooms);}
/* Updated 3 July 2013 5:33 am FreiChatX  V.9.0 */