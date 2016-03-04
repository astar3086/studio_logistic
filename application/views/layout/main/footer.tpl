<div id="footer" class="col-xs-12 col-md-4 container   ">
             
                <div class="row">
                    <div class="col-xs-9 col-md-9 pull-left">
                <p class="text-muted">Logistic Personal Digital Assistant</p>
                <a href="#">{__('FAQ')}</a>
                <a href="#">{__('Feedback')}</a>
                <a href="#">{__('Affiliate_program')}</a>
            </div>
            <div class="col-xs-3 col-md-3 pull-right">
                <a href="#"><img src=" {$base_UI}img/black_grad_small.png"></a>
                <a href="#"><img src=" {$base_UI}img/ic_android_128_28230.png"></a>
                <p class="text-muted mobile_p">{__('Mobile_applications')}</p>
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