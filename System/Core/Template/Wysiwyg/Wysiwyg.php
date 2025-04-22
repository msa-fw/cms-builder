<?php

namespace System\Core\Template\Wysiwyg;

use System\Core\Language;

class Wysiwyg
{
    public static function default()
    {
        $buttonsList = array();
        $buttons = new Buttons($buttonsList);

        $buttons->fullScreen()->title(Language::System('wysiwyg.button.title.fullScreen')->returnKey());
        $buttons->remove()->title(Language::System('wysiwyg.button.title.remove')->returnKey());
        $buttons->editSource()->title(Language::System('wysiwyg.button.title.editSource')->returnKey());
        $buttons->showBlocks()->title(Language::System('wysiwyg.button.title.showBlocks')->returnKey());

        $buttons->limiter();

        $buttons->bold()->title(Language::System('wysiwyg.button.title.bold')->returnKey());
        $buttons->italic()->title(Language::System('wysiwyg.button.title.italic')->returnKey());
        $buttons->strike()->title(Language::System('wysiwyg.button.title.strike')->returnKey());
        $buttons->underline()->title(Language::System('wysiwyg.button.title.underline')->returnKey());

        $buttons->limiter();

        $buttons->quote()->title(Language::System('wysiwyg.button.title.quote')->returnKey());
        $buttons->code()->title(Language::System('wysiwyg.button.title.code')->returnKey());
        $buttons->hr()->title(Language::System('wysiwyg.button.title.hr')->returnKey());
        $buttons->header()->title(Language::System('wysiwyg.button.title.header')->returnKey());
        $buttons->h1()->title(Language::System('wysiwyg.button.title.header1')->returnKey())->parent('header')->icon(Attributes::ICON_PACK['header']);
        $buttons->h2()->title(Language::System('wysiwyg.button.title.header2')->returnKey())->parent('header')->icon(Attributes::ICON_PACK['header']);
        $buttons->h3()->title(Language::System('wysiwyg.button.title.header3')->returnKey())->parent('header')->icon(Attributes::ICON_PACK['header']);
        $buttons->h4()->title(Language::System('wysiwyg.button.title.header4')->returnKey())->parent('header')->icon(Attributes::ICON_PACK['header']);
        $buttons->h5()->title(Language::System('wysiwyg.button.title.header5')->returnKey())->parent('header')->icon(Attributes::ICON_PACK['header']);
        $buttons->h6()->title(Language::System('wysiwyg.button.title.header6')->returnKey())->parent('header')->icon(Attributes::ICON_PACK['header']);
        $buttons->link()->title(Language::System('wysiwyg.button.title.link')->returnKey());
        $buttons->table()->title(Language::System('wysiwyg.button.title.table')->returnKey());

        $buttons->limiter();

        $buttons->align()->title(Language::System('wysiwyg.button.title.align')->returnKey());
        $buttons->alignCenter()->title(Language::System('wysiwyg.button.title.alignCenter')->returnKey())->parent('align');
        $buttons->alignJustify()->title(Language::System('wysiwyg.button.title.alignJustify')->returnKey())->parent('align');
        $buttons->alignLeft()->title(Language::System('wysiwyg.button.title.alignLeft')->returnKey())->parent('align');
        $buttons->alignRight()->title(Language::System('wysiwyg.button.title.alignRight')->returnKey())->parent('align');
        $buttons->list()->title(Language::System('wysiwyg.button.title.list')->returnKey());
        $buttons->listRating()->title(Language::System('wysiwyg.button.title.listRating')->returnKey())->parent('list');
        $buttons->listCircled()->title(Language::System('wysiwyg.button.title.listCircled')->returnKey())->parent('list');
        $buttons->listPointer()->title(Language::System('wysiwyg.button.title.listPointer')->returnKey())->parent('list');
        $buttons->listCheckbox()->title(Language::System('wysiwyg.button.title.listCheckbox')->returnKey())->parent('list');
        $buttons->outlineList()->title(Language::System('wysiwyg.button.title.outlineList')->returnKey());
        $buttons->outlineListInteger()->title(Language::System('wysiwyg.button.title.outlineListInteger')->returnKey())->parent('outlineList');
        $buttons->outlineListLetter()->title(Language::System('wysiwyg.button.title.outlineListLetter')->returnKey())->parent('outlineList');
        $buttons->outlineListRoman()->title(Language::System('wysiwyg.button.title.outlineListRoman')->returnKey())->parent('outlineList');

        $buttons->limiter();

        $buttons->audio()->title(Language::System('wysiwyg.button.title.audio')->returnKey());
        $buttons->image()->title(Language::System('wysiwyg.button.title.image')->returnKey());
        $buttons->video()->title(Language::System('wysiwyg.button.title.video')->returnKey());
        $buttons->file()->title(Language::System('wysiwyg.button.title.file')->returnKey());

        return $buttonsList;
    }

    public static function minimal()
    {
        $buttonsList = array();
        $buttons = new Buttons($buttonsList);

        $buttons->bold()->title(Language::System('wysiwyg.button.title.bold')->returnKey());
        $buttons->italic()->title(Language::System('wysiwyg.button.title.italic')->returnKey());
        $buttons->strike()->title(Language::System('wysiwyg.button.title.strike')->returnKey());
        $buttons->underline()->title(Language::System('wysiwyg.button.title.underline')->returnKey());

        $buttons->limiter();

        $buttons->code()->title(Language::System('wysiwyg.button.title.code')->returnKey());
        $buttons->quote()->title(Language::System('wysiwyg.button.title.quote')->returnKey());
        $buttons->link()->title(Language::System('wysiwyg.button.title.link')->returnKey());

        $buttons->limiter();

        $buttons->audio()->title(Language::System('wysiwyg.button.title.audio')->returnKey());
//        $buttons->fileManager()->title(Language::System('wysiwyg.button.title.fileManager')->returnKey())->parent('audio');
//        $buttons->fileRemote()->title(Language::System('wysiwyg.button.title.fileRemote')->returnKey())->parent('audio');
//        $buttons->fileUpload()->title(Language::System('wysiwyg.button.title.fileUpload')->returnKey())->parent('audio');
        $buttons->image()->title(Language::System('wysiwyg.button.title.image')->returnKey());
//        $buttons->fileManager()->title(Language::System('wysiwyg.button.title.fileManager')->returnKey())->parent('image');
//        $buttons->fileRemote()->title(Language::System('wysiwyg.button.title.fileRemote')->returnKey())->parent('image');
//        $buttons->fileUpload()->title(Language::System('wysiwyg.button.title.fileUpload')->returnKey())->parent('image');
        $buttons->video()->title(Language::System('wysiwyg.button.title.video')->returnKey());
//        $buttons->fileManager()->title(Language::System('wysiwyg.button.title.fileManager')->returnKey())->parent('video');
//        $buttons->fileRemote()->title(Language::System('wysiwyg.button.title.fileRemote')->returnKey())->parent('video');
//        $buttons->fileUpload()->title(Language::System('wysiwyg.button.title.fileUpload')->returnKey())->parent('video');
        $buttons->file()->title(Language::System('wysiwyg.button.title.file')->returnKey());
//        $buttons->fileManager()->title(Language::System('wysiwyg.button.title.fileManager')->returnKey())->parent('file');
//        $buttons->fileRemote()->title(Language::System('wysiwyg.button.title.fileRemote')->returnKey())->parent('file');
//        $buttons->fileUpload()->title(Language::System('wysiwyg.button.title.fileUpload')->returnKey())->parent('file');

        return $buttonsList;
    }

    public static function getLangPack()
    {
        return array(
            'wysiwyg.default.value.audio' => Language::System('wysiwyg.default.value.audio')->read(),
            'wysiwyg.default.value.image' => Language::System('wysiwyg.default.value.image')->read(),
            'wysiwyg.default.value.video' => Language::System('wysiwyg.default.value.video')->read(),
            'input.title.placeholder' => Language::System('input.title.placeholder')->read(),
            'input.href.placeholder' => Language::System('input.href.placeholder')->read(),
        );
    }
}