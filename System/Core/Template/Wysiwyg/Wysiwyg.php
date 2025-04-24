<?php

namespace System\Core\Template\Wysiwyg;

use System\Core\Language;

class Wysiwyg
{
    public static function default()
    {
        $buttonsList = array();
        $buttons = new Buttons($buttonsList);

        $buttons->fullScreen()->title('wysiwyg.button.title.fullScreen');
        $buttons->remove()->title('wysiwyg.button.title.remove');
        $buttons->editSource()->title('wysiwyg.button.title.editSource');
        $buttons->showBlocks()->title('wysiwyg.button.title.showBlocks');

        $buttons->limiter();

        $buttons->bold()->title('wysiwyg.button.title.bold');
        $buttons->italic()->title('wysiwyg.button.title.italic');
        $buttons->strike()->title('wysiwyg.button.title.strike');
        $buttons->underline()->title('wysiwyg.button.title.underline');

        $buttons->limiter();

        $buttons->quote()->title('wysiwyg.button.title.quote');
        $buttons->code()->title('wysiwyg.button.title.code');
        $buttons->hr()->title('wysiwyg.button.title.hr');
        $buttons->header()->title('wysiwyg.button.title.header');
        $buttons->h1()->title('wysiwyg.button.title.header1')->parent('header')->icon(Attributes::ICON_PACK['header']);
        $buttons->h2()->title('wysiwyg.button.title.header2')->parent('header')->icon(Attributes::ICON_PACK['header']);
        $buttons->h3()->title('wysiwyg.button.title.header3')->parent('header')->icon(Attributes::ICON_PACK['header']);
        $buttons->h4()->title('wysiwyg.button.title.header4')->parent('header')->icon(Attributes::ICON_PACK['header']);
        $buttons->h5()->title('wysiwyg.button.title.header5')->parent('header')->icon(Attributes::ICON_PACK['header']);
        $buttons->h6()->title('wysiwyg.button.title.header6')->parent('header')->icon(Attributes::ICON_PACK['header']);
        $buttons->table()->title('wysiwyg.button.title.table');

        $buttons->limiter();

        $buttons->align()->title('wysiwyg.button.title.align');
        $buttons->alignCenter()->title('wysiwyg.button.title.alignCenter')->parent('align');
        $buttons->alignJustify()->title('wysiwyg.button.title.alignJustify')->parent('align');
        $buttons->alignLeft()->title('wysiwyg.button.title.alignLeft')->parent('align');
        $buttons->alignRight()->title('wysiwyg.button.title.alignRight')->parent('align');
        $buttons->list()->title('wysiwyg.button.title.list');
        $buttons->listRating()->title('wysiwyg.button.title.listRating')->parent('list');
        $buttons->listCircled()->title('wysiwyg.button.title.listCircled')->parent('list');
        $buttons->listPointer()->title('wysiwyg.button.title.listPointer')->parent('list');
        $buttons->listCheckbox()->title('wysiwyg.button.title.listCheckbox')->parent('list');
        $buttons->outlineList()->title('wysiwyg.button.title.outlineList');
        $buttons->outlineListInteger()->title('wysiwyg.button.title.outlineListInteger')->parent('outlineList');
        $buttons->outlineListLetter()->title('wysiwyg.button.title.outlineListLetter')->parent('outlineList');
        $buttons->outlineListRoman()->title('wysiwyg.button.title.outlineListRoman')->parent('outlineList');

        $buttons->limiter();

        $buttons->link()->title('wysiwyg.button.title.link');
        $buttons->link()->title('wysiwyg.button.title.hyperlink')->parent('link');
        $buttons->audio()->title('wysiwyg.button.title.audio')->parent('link');
        $buttons->image()->title('wysiwyg.button.title.image')->parent('link');
        $buttons->video()->title('wysiwyg.button.title.video')->parent('link');
        $buttons->file()->title('wysiwyg.button.title.file')->parent('link');

        return $buttonsList;
    }

    public static function minimal()
    {
        $buttonsList = array();
        $buttons = new Buttons($buttonsList);

        $buttons->bold()->title('wysiwyg.button.title.bold');
        $buttons->italic()->title('wysiwyg.button.title.italic');
        $buttons->strike()->title('wysiwyg.button.title.strike');
        $buttons->underline()->title('wysiwyg.button.title.underline');

        $buttons->limiter();

        $buttons->code()->title('wysiwyg.button.title.code');
        $buttons->quote()->title('wysiwyg.button.title.quote');
        $buttons->link()->title('wysiwyg.button.title.link');

        $buttons->limiter();

        $buttons->audio()->title('wysiwyg.button.title.audio');
//        $buttons->fileManager()->title('wysiwyg.button.title.fileManager')->parent('audio');
//        $buttons->fileRemote()->title('wysiwyg.button.title.fileRemote')->parent('audio');
//        $buttons->fileUpload()->title('wysiwyg.button.title.fileUpload')->parent('audio');
        $buttons->image()->title('wysiwyg.button.title.image');
//        $buttons->fileManager()->title('wysiwyg.button.title.fileManager')->parent('image');
//        $buttons->fileRemote()->title('wysiwyg.button.title.fileRemote')->parent('image');
//        $buttons->fileUpload()->title('wysiwyg.button.title.fileUpload')->parent('image');
        $buttons->video()->title('wysiwyg.button.title.video');
//        $buttons->fileManager()->title('wysiwyg.button.title.fileManager')->parent('video');
//        $buttons->fileRemote()->title('wysiwyg.button.title.fileRemote')->parent('video');
//        $buttons->fileUpload()->title('wysiwyg.button.title.fileUpload')->parent('video');
        $buttons->file()->title('wysiwyg.button.title.file');
//        $buttons->fileManager()->title('wysiwyg.button.title.fileManager')->parent('file');
//        $buttons->fileRemote()->title('wysiwyg.button.title.fileRemote')->parent('file');
//        $buttons->fileUpload()->title('wysiwyg.button.title.fileUpload')->parent('file');

        return $buttonsList;
    }

    public static function getLangPack()
    {
        return array(
            'input.href.placeholder'                    => Language::System('input.href.placeholder')->returnKey(),
            'input.title.placeholder'                   => Language::System('input.title.placeholder')->returnKey(),
            'wysiwyg.default.value.audio'               => Language::System('wysiwyg.default.value.audio')->returnKey(),
            'wysiwyg.default.value.image'               => Language::System('wysiwyg.default.value.image')->returnKey(),
            'wysiwyg.default.value.video'               => Language::System('wysiwyg.default.value.video')->returnKey(),
            'wysiwyg.button.title.remove'               => Language::System('wysiwyg.button.title.remove')->returnKey(),
            'wysiwyg.button.title.editSource'           => Language::System('wysiwyg.button.title.editSource')->returnKey(),
            'wysiwyg.button.title.showBlocks'           => Language::System('wysiwyg.button.title.showBlocks')->returnKey(),
            'wysiwyg.button.title.bold'                 => Language::System('wysiwyg.button.title.bold')->returnKey(),
            'wysiwyg.button.title.italic'               => Language::System('wysiwyg.button.title.italic')->returnKey(),
            'wysiwyg.button.title.strike'               => Language::System('wysiwyg.button.title.strike')->returnKey(),
            'wysiwyg.button.title.underline'            => Language::System('wysiwyg.button.title.underline')->returnKey(),
            'wysiwyg.button.title.header'               => Language::System('wysiwyg.button.title.header')->returnKey(),
            'wysiwyg.button.title.header1'              => Language::System('wysiwyg.button.title.header1')->returnKey(),
            'wysiwyg.button.title.header2'              => Language::System('wysiwyg.button.title.header2')->returnKey(),
            'wysiwyg.button.title.header3'              => Language::System('wysiwyg.button.title.header3')->returnKey(),
            'wysiwyg.button.title.header4'              => Language::System('wysiwyg.button.title.header4')->returnKey(),
            'wysiwyg.button.title.header5'              => Language::System('wysiwyg.button.title.header5')->returnKey(),
            'wysiwyg.button.title.header6'              => Language::System('wysiwyg.button.title.header6')->returnKey(),
            'wysiwyg.button.title.quote'                => Language::System('wysiwyg.button.title.quote')->returnKey(),
            'wysiwyg.button.title.code'                 => Language::System('wysiwyg.button.title.code')->returnKey(),
            'wysiwyg.button.title.link'                 => Language::System('wysiwyg.button.title.link')->returnKey(),
            'wysiwyg.button.title.hyperlink'            => Language::System('wysiwyg.button.title.hyperlink')->returnKey(),
            'wysiwyg.button.title.hr'                   => Language::System('wysiwyg.button.title.hr')->returnKey(),
            'wysiwyg.button.title.table'                => Language::System('wysiwyg.button.title.table')->returnKey(),
            'wysiwyg.button.title.align'                => Language::System('wysiwyg.button.title.align')->returnKey(),
            'wysiwyg.button.title.alignCenter'          => Language::System('wysiwyg.button.title.alignCenter')->returnKey(),
            'wysiwyg.button.title.alignJustify'         => Language::System('wysiwyg.button.title.alignJustify')->returnKey(),
            'wysiwyg.button.title.alignLeft'            => Language::System('wysiwyg.button.title.alignLeft')->returnKey(),
            'wysiwyg.button.title.alignRight'           => Language::System('wysiwyg.button.title.alignRight')->returnKey(),
            'wysiwyg.button.title.list'                 => Language::System('wysiwyg.button.title.list')->returnKey(),
            'wysiwyg.button.title.listRating'           => Language::System('wysiwyg.button.title.listRating')->returnKey(),
            'wysiwyg.button.title.listCircled'          => Language::System('wysiwyg.button.title.listCircled')->returnKey(),
            'wysiwyg.button.title.listPointer'          => Language::System('wysiwyg.button.title.listPointer')->returnKey(),
            'wysiwyg.button.title.listCheckbox'         => Language::System('wysiwyg.button.title.listCheckbox')->returnKey(),
            'wysiwyg.button.title.outlineList'          => Language::System('wysiwyg.button.title.outlineList')->returnKey(),
            'wysiwyg.button.title.outlineListInteger'   => Language::System('wysiwyg.button.title.outlineListInteger')->returnKey(),
            'wysiwyg.button.title.outlineListLetter'    => Language::System('wysiwyg.button.title.outlineListLetter')->returnKey(),
            'wysiwyg.button.title.outlineListRoman'     => Language::System('wysiwyg.button.title.outlineListRoman')->returnKey(),
            'wysiwyg.button.title.audio'                => Language::System('wysiwyg.button.title.audio')->returnKey(),
            'wysiwyg.button.title.image'                => Language::System('wysiwyg.button.title.image')->returnKey(),
            'wysiwyg.button.title.video'                => Language::System('wysiwyg.button.title.video')->returnKey(),
            'wysiwyg.button.title.file'                 => Language::System('wysiwyg.button.title.file')->returnKey(),
            'wysiwyg.button.title.fileManager'          => Language::System('wysiwyg.button.title.fileManager')->returnKey(),
            'wysiwyg.button.title.fileRemote'           => Language::System('wysiwyg.button.title.fileRemote')->returnKey(),
            'wysiwyg.button.title.fileUpload'           => Language::System('wysiwyg.button.title.fileUpload')->returnKey(),
            'wysiwyg.button.title.fullScreen'           => Language::System('wysiwyg.button.title.fullScreen')->returnKey(),
        );
    }
}