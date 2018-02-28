// JavaScript Document

$(".logOut").click(function(){
	$('.modalLogOut').show();
});

$('.closeModal').click(function(){
	$('.modal').fadeOut();
});

$('.confirmLogOut').click(function(){
	document.location.href="/admin/logout";
});

$('.deleteChap').click(function(){
	var theId  = $(this).attr('id');
	$('.modalDeleteChap').show();
	$('.confirmDeleteChap').click(function(){
		document.location.href="/admin/chapters-delete-"+theId+"\.html";
	});
});

$('.deleteCom').click(function(){
	var theId= $(this).attr('id');
	$('.modalDeleteCom').show();
	$('.confirmDeleteCom').click(function(){
		document.location.href="/admin/comment-delete-"+theId+".html";
	});
});
