<?=$this->doctype('XHTML1_STRICT');?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
        <?=$this->includeCode('header')?>
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="shortcut icon" href="/assets/web/images/favicon.ico" />
        <link rel="shortcut icon" href="/assets/web/images/favicon.ico" type="image/x-icon" />
        <link rel="apple-touch-icon" href="/assets/web/images/apple-touch-icon.png" />
        <link rel="apple-touch-icon" sizes="57x57" href="/assets/web/images/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="/assets/web/images/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="76x76" href="/assets/web/images/apple-touch-icon-76x76.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="/assets/web/images/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="120x120" href="/assets/web/images/apple-touch-icon-120x120.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="/assets/web/images/apple-touch-icon-144x144.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="/assets/web/images/apple-touch-icon-152x152.png" />
    </head>
    <body class="frontend scrolled">
        <div class="pageWrapper">
            <div id="page">
                <div id="outerHeader">
                    <div id="header">
                        <div class="menues">
                        </div>
                    </div>
                </div>
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
                    </div>
                </div>
            </div>
        </div>
        <?=$this->includeCode('footer')?>
    </body>
</html>
