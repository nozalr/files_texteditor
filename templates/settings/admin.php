<?php
script('files_texteditor', 'settings/settings');
?>

<div class="section">
    <h2>TextEditor</h2>
    <?php if ($_['message']): ?>
        <span><?php p($_['message']); ?></span>
    <?php endif; ?>
    <hidden id="settings-mode" value="global"/>
    <p>
        <label style="display:inline-block;min-width:200px" for="editor-keybindings">
            <?php p($l->t('Editor keybindings')); ?>
        </label>
        <? $keybindings = $_['editor-keybindings']; ?>
        <select id="editor-keybindings" name="editor-keybindings">
            <option value="normal" <?php if ($keybindings === 'normal') {
                echo 'selected="selected"';
            } else {
                echo '';
            } ?> ><?php p($l->t('normal')); ?>
            </option>
            <option value="vim" <?php if ($keybindings === 'vim') {
                echo 'selected="selected"';
            } else {
                echo '';
            } ?> >vim
            </option>
            <option value="emacs" <?php if ($keybindings === 'emacs') {
                echo 'selected="selected"';
            } else {
                echo '';
            } ?> >emacs
            </option>
        </select>
    </p>
</div>
