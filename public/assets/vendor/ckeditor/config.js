/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For the complete reference:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	//Integrate kcfinder
	config.filebrowserBrowseUrl = 'ckeditor/kcfinder/browse.php?type=files&dir=img/upload/other&opener=ckeditor';
   	config.filebrowserImageBrowseUrl = 'ckeditor/kcfinder/browse.php?type=images&dir=img/upload/other&opener=ckeditor';
   	config.filebrowserFlashBrowseUrl = 'ckeditor/kcfinder/browse.php?type=flash&dir=img/upload/other&opener=ckeditor';
   	config.filebrowserUploadUrl = 'ckeditor/kcfinder/upload.php?type=files&dir=img/upload/other&opener=ckeditor';
   	config.filebrowserImageUploadUrl = 'ckeditor/kcfinder/upload.php?type=images&dir=img/upload/other&opener=ckeditor';
   	config.filebrowserFlashUploadUrl = 'ckeditor/kcfinder/upload.php?type=flash&dir=img/upload/other&opener=ckeditor';

	// The toolbar groups arrangement, optimized for a single toolbar row.
	config.toolbarGroups = [
		//{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		//{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		//{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'forms' },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'links', groups: [ 'image'] },
		{ name: 'insert' },
		{ name: 'styles' },
		{ name: 'image' },
		{ name: 'colors' }/*,
		{ name: 'tools' },
		{ name: 'others' },
		{ name: 'about' }*/
	];

	config.width = '100%';
	config.height = '380';
	// The default plugins included in the basic setup define some buttons that
	// we don't want too have in a basic editor. We remove them here.
	config.removeButtons = 'Preview,Cut,Copy,Paste,Undo,Redo,Anchor,Underline,Strike,Subscript,Superscript';

	// Let's have it basic on dialogs as well.
	config.removeDialogTabs = 'link:advanced';

};