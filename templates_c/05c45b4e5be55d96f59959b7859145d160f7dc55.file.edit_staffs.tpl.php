<?php /* Smarty version Smarty-3.1.11, created on 2017-08-14 15:44:08
         compiled from ".\templates\edit_staffs.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10799577a02aac5dd83-82689154%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '05c45b4e5be55d96f59959b7859145d160f7dc55' => 
    array (
      0 => '.\\templates\\edit_staffs.tpl',
      1 => 1502700131,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10799577a02aac5dd83-82689154',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_577a02aaf16626_26813312',
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'staffID' => 0,
    'photo' => 0,
    'staffCode' => 0,
    'staffName' => 0,
    'position' => 0,
    'level' => 0,
    'statusStaff' => 0,
    'email' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_577a02aaf16626_26813312')) {function content_577a02aaf16626_26813312($_smarty_tpl) {?><script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<link href="design/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="design/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<script src="design/js/bootstrap.min.js" type="text/javascript"></script>
	
<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>

<script type="text/javascript" src="design/js/ajaxupload.3.5.js" ></script>
<link rel="stylesheet" type="text/css" href="design/css/Ajaxfile-upload.css" />

<body style='background-color: #EEE; color: #333;'>

	<script>
		$(document).ready(function() {
			
			$('.dropdown-menu').on('click', function(e) {
				if($(this).hasClass('dropdown-menu-form')) {
					e.stopPropagation();
				}
			});
			
			$("#staff").submit(function() { return false; });
			
			// Image 1
			var btnUpload=$('#me');
			var mestatus=$('#mestatus');
			var files=$('#files');
			new AjaxUpload(btnUpload, {
				action: 'upload_staff.php',
				name: 'uploadfile',
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|jpeg)$/.test(ext))){ 
	                    // extension is not allowed 
						mestatus.text('Hanya ekstensi .JPG/JPEG yang diijinkan.');
						return false;
					}
					//mestatus.html('<img src="images/ajax-loader.gif" height="16" width="16">');
					mestatus.html('');
				},
				onComplete: function(file, response){
					//On completion clear the status
					mestatus.text('');
					//On completion clear the status
					files.html('');
					//Add uploaded file to list
					if(response!=="error"){
						$('<li></li>').appendTo('#files').html('<img src="img/staffs/'+response+'" alt="" height="100"/><br />').addClass('success');
						$('<li></li>').appendTo('#photostaff').html('<input type="hidden" id="photo" name="photo" value="'+response+'">').addClass('nameupload');
						
					} else{
						$('<li></li>').appendTo('#files').text(file).addClass('error');
					}
				}
			});
			
			$("#deletephoto").on("click", function(){
				parent.jQuery.fancybox.close();
			});
	
			$("#send").on("click", function(){
				var staffID2 = $("#staffID2").val();
				var staffCode = $("#staffCode").val();
				var staffName = $("#staffName").val();
				var position = $("#position").val();
				var statusStaff = $("#statusStaff").val();
				var level = $("#level").val();
				var email = $("#email").val();
				var password = $("#password").val();
				
				if (staffID2 != '' && staffCode != '' && staffName != '' && statusStaff != '' && level != '' && email != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_staff.php',
						dataType: 'JSON',
						data:{
							staffID2: staffID2,
							staffCode: staffCode,
							staffName: staffName,
							position: position,
							statusStaff: statusStaff,
							level: level,
							email: email,
							password: password
						},
						beforeSend: function (data) {
							$('#send').hide();
						},
						success: function(data) {
							parent.jQuery.fancybox.close();
						}
					});
				}
			});
		});
	</script>	

				

<?php if ($_smarty_tpl->tpl_vars['module']->value=='staff'&&$_smarty_tpl->tpl_vars['act']->value=='edit'){?>
	<table width="95%" align="center">
		<tr>
			<td align="center"><h3><b>DATABASE STAFF</b></h3></td>
		</tr>
		<tr>
			<td>
				<form id="staff" name="staff" method="POST" action="#">
				<input type="hidden" id="staffID2" name="staffID2" value="<?php echo $_smarty_tpl->tpl_vars['staffID']->value;?>
">
				<input type="hidden" id="foto" name="foto" value="<?php echo $_smarty_tpl->tpl_vars['photo']->value;?>
">
				<table cellpadding="3" cellspacing="3">
					<tr>
						<td width="130" style="font-size: 14px;">Kode</td>
						<td width="5" style="font-size: 14px;">:</td>
						<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['staffCode']->value;?>
" id="staffCode" name="staffCode" class="form-control" placeholder="Kode Customer" style="width: 270px;" required></td>
						<td></td>
						<td colspan="3"></td>
					</tr>
					
					<tr>
						<td  width="130" style="font-size: 14px;">Nama Lengkap</td>
						<td>:</td>
						<td><input type="text" id="staffName" value="<?php echo $_smarty_tpl->tpl_vars['staffName']->value;?>
" name="staffName" class="form-control" placeholder="Nama Staff" style="width: 270px;" required></td>
						<td></td>
						</tr>
						<tr>
						<td style="font-size: 14px;">Jabatan</td>
						<td style="font-size: 14px;">:</td>
						<td><input type="text" id="position" value="<?php echo $_smarty_tpl->tpl_vars['position']->value;?>
" name="position" class="form-control" placeholder="Jabatan / Posisi" style="width: 270px;"></td>
					</tr>
					
					<tr>
						<td style="font-size: 14px;">Level</td>
						<td style="font-size: 14px;">:</td>
						<td>
							<select id="level" name="level" class="form-control" style="width: 270px;" required>
								<option value=""></option>
								<option value="1" <?php if ($_smarty_tpl->tpl_vars['level']->value=='1'){?> SELECTED <?php }?>>Administrator</option>
								<option value="2" <?php if ($_smarty_tpl->tpl_vars['level']->value=='2'){?> SELECTED <?php }?>>Good Receiving</option>
								<option value="4" <?php if ($_smarty_tpl->tpl_vars['level']->value=='4'){?> SELECTED <?php }?>>ALC/VM</option>
								<option value="5" <?php if ($_smarty_tpl->tpl_vars['level']->value=='5'){?> SELECTED <?php }?>>Pimpinan</option>
							</select>
						</td>
					</tr>
					<tr>
						<td style="font-size: 14px;">Status</td>
						<td style="font-size: 14px;">:</td>
						<td>
							<select id="statusStaff" name="statusStaff" class="form-control" style="width: 270px;" required>
								<option value=""></option>
								<option value="Y" <?php if ($_smarty_tpl->tpl_vars['statusStaff']->value=='Y'){?> SELECTED <?php }?>>Y [Aktif]</option>
								<option value="N" <?php if ($_smarty_tpl->tpl_vars['statusStaff']->value=='N'){?> SELECTED <?php }?>>N [Tidak Aktif]</option>
							</select>
						</td>
					</tr>
					<tr valign="top">
						
						<td style="font-size: 14px;">Password</td>
						<td style="font-size: 14px;">:</td>
						<td><input type="text" id="password" name="password" class="form-control" placeholder="Password" style="width: 270px;"> <br> <span style="font-size: 10pt;">*) Kosongkan, jika password tidak ingin diubah</span></td>
					</tr>
					
					
					<tr>
						<td>Email</td>
						<td >:</td>
						<td><input type="email" id="email" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
" name="email" class="form-control" placeholder="Email" style="width: 270px;" required></td>
						<td></td>
						<td colspan="3"></td>
					</tr>
				</table>
				<br>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

<?php }?>
</body><?php }} ?>