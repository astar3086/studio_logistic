<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-9 pull-left">
                <p class="text-muted">Logistic Personal Digital Assistant</p>
                <a href="#">Частые вопросы</a>
                <a href="#">Обратная связь</a>
                <a href="#">Партнерская программа</a>
            </div>
            <div class="col-md-3 pull-right">
                <a href="#"><img src=" {$base_UI}img/black_grad_small.png"></a>
                <a href="#"><img src=" {$base_UI}img/ic_android_128_28230.png"></a>
                <p class="text-muted mobile_p">Мобильные приложения</p>
            </div>
        </div>
    </div>
</div>

{Assets::js()}
{block name="jscode"}{/block}

</body>
</html>
{if $debugging}

    {*debug*}
    {ProfilerToolbar::render()}
{/if}