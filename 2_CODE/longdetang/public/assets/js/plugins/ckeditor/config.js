/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
    config.height = 450;
    config.skin = 'bootstrapck';
    config.filebrowserImageUploadUrl = url('/uploadForCK/file.do');
    config.extraPlugins = 'colorbutton,video,filebrowser,lineheight,letterspacing,indent,indentblock';
    config.filebrowserUploadUrl = "";
};
