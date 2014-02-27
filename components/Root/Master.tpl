<?=$this->doctype('XHTML1_STRICT');?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?=$this->includeCode('header')?>
        <link rel="shortcut icon" href="/assets/web/images/favicon.ico" /> 
        <meta name="viewport" content="width=device-width, initial-scale=1" />
    </head>
    <body class="frontend">
        <div id="page">
            <div id="outerHeader">
                <div id="header">
                    <div id="logo" class="logo"><div class="domain">vtinfos</div><div class="tld">.com</div></div>
                    <div class="menues">
                        <div id="mainMenu">
                            <?=$this->component($this->boxes['mainMenu']);?>
                        </div>
                        <?if ($this->hasContent($this->boxes['subMenu'])) {?>
                            <div id="subMenu">
                                <?=$this->component($this->boxes['subMenu']);?>
                            </div>
                        <?}?>
                    </div>
                    <div class="clear"></div>
                    <a class="logout webStandard" href="/kwf/user/logout"><?=$this->data->trl('Abmelden');?></a>
                </div>
            </div>
            <div class="clear"></div>
            <div id="outerContent">
                <div id="content">
                    <div id="innerContent">
                        <?=$this->component($this->data);?>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div id="outerFooter">
                <div id="footer" class="webStandard">
                    <?=$this->component($this->boxes['bottomMenu']);?>
                    <?=$this->includeCode('footer')?>
                </div>
            </div>
        </div>
    </body>
</html>
