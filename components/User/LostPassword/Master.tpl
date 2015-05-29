<?=$this->doctype('XHTML1_STRICT');?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
        <?=$this->includeCode('header')?>
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="shortcut icon" href="/assets/web/images/favicon.ico" />
        <link rel="shortcut icon" href="/assets/web/images/favicon.ico" type="image/x-icon" />
        <link rel="apple-touch-icon" href="/assets/web/images/logo.jpg" />
        <meta name="msapplication-square512x512logo" content="/assets/web/images/logo.jpg">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="theme-color" content="#085ac0">
        <link rel="manifest" href="/manifest.json" />
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
