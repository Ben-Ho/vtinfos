<div class="<?=$this->cssClass?>">
    <div class="mobileTitle">
        <div class="logo">VT</div>
        <div class="title">
            <?=$this->pageName;?>
        </div>
        <a href="/kwf/user/logout" class="logout"><img class="icon" src="/assets/web/images/logout.png" height="30" width="28"></a>
    </div>
    <?=$this->component($this->menu);?>
</div>
