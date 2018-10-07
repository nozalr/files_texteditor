# Texteditor

[![Build Status](https://travis-ci.org/nextcloud/files_texteditor.svg?branch=master)](https://travis-ci.org/nextcloud/files_texteditor)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/nextcloud/files_texteditor/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/nextcloud/files_texteditor/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/nextcloud/files_texteditor/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/nextcloud/files_texteditor/?branch=master)


The original text editor app for Nextcloud, based on [Ace](http://ace.c9.io/).

Features:
 - Syntax highlighting
 - Autosave
 - Syntax checking
 - Responsive design (optimised on mobile and desktop)

## Fork motivation (Group4Layers)

Group4Layers® organization uses Emacs and Vim keybindings in many applications, and therefore, Nextcloud should provide a simple editor with these features.

Also, we usually customize Vim with `jk` to escape from `insert` mode, although others use `kj` for the same purpose. This extension should modify the Vim configuration by default.

Group4Layers doesn't want to force anyone to use a specific editor keybindings. Every member can establish its own personal configuration (editor keybindings).

### Workflow

Administrator can set the default editor keybindings (normal, vim or emacs).

Every member can set its own editor keybindings (normal, vim or emacs).

When a member is loading a file with the `files_texteditor`, it queries the personal settings and establish the editor keybindings accordingly.

### Contributions

Feel free to establish new settings or features. You can contribute with a PR or open an issue with your bugs/requests. We encourage you to add more features.

Possible contributions:

- translations for other languages (currently `es`, apart from english).
- allow custom mimetypes/modes mapping for the editor (`org-mode` or custom modes).
- create a save button for those that want to `save` manually but `ctrl-s` is overwritten by the keybindings.
- create a mode switching select button, to manually establish the mode for the editor at runtime.
- when another user is editing a file, open the same file in read-only / viewer mode.
- ...


## Install
Simply copy the `files_texteditor` folder into the `apps` directory and enable the app within the Nextcloud settings.

## Usage
To use the editer, click on a [supported file](https://github.com/nextcloud/files_texteditor/blob/master/js/editor.js#L6) within the Files app and the file will be loaded into the editor. Saving is automatic, but can also be triggered manually with `Ctrl+S` or `Cmd+S`.

## Contributors
Maintainer: [Tom Needham](http://github.com/tomneedham)
Past contributors: [Thomas Müller](http://github.com/deepdiver1975) [Robin Appelman](http://github.com/icewind) [Jörn Friedrich Dreyer](http://github.com/butonic) [Vincent Petry](http://github.com/pvince)


Preview apps
------------

Apps can add side-by-side previews to the app for certain file types by using the preview api

```js

OCA.MYApp.Preview = function(){
    ...
}

OCA.MYApp.Preview.Prototype = {
    /**
     * Give the app the opportunity to load any resources it needs and prepare for rendering a preview
     */
    init: function() {
        ...
    },
    /**
     * @param {string} the text to create the preview for
     * @param {jQuery} the jQuery element to render the preview in
     */
    preview: function(text, previewElement) {
        ...
    }
}

OCA.Files_Texteditor.registerPreviewPlugin('text/markdown', new OCA.MYApp.Preview());

```

For styling of the preview, the preview element will have the id `preview` and the className will be set to the mimetype of the file being eddited with any slash replaced by dashes.

e.g. when editing a markdown file the preview element can be styled using the `#preview.text-markdown` css query.
