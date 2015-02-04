<div class="<?=$this->cssClass?>">
    <div class="mobileTitle">
        <a href="/" class="logo">VT</a>
        <div class="title">
            <?=$this->pageName;?>
        </div>
        <div class="languages">
            <img class="icon" src="/assets/web/images/language.png" width="35" height="35">
        </div>
        <a href="/kwf/user/logout" class="logout"><img class="icon" src="/assets/web/images/logout.png" height="30" width="28"></a>
    </div>
    <?=$this->component($this->languages);?>
    <?=$this->component($this->menu);?>
</div>
