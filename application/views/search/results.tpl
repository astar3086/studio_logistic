{**
 * Created by Wir_Wolf.
 * Author: Andru Cherny
 * E-mail: wir_wolf@bk.ru
 * Date: 06.03.14
 * Time: 16:19
 *}
{extends file="../layout/add.tpl"}
{block name=content}
    <div class="content">
        <div class="col-md-12">
            <div class="search_block search">
                <form role="form" id="SubmitForm" action="/{Route::get('pages')->uri(['controller'=>'Search','action'=>'index'])}" method="POST">
                    <p><input type="text" name="search" value="{$search}" placeholder="   ">
                    <input type="submit" name="subway" class="subway">
                    </p><br>
                    <div class="block-category">
                    <p><input type="radio" name="category" {if $category eq 1} checked {/if} value="1" checked>   By All Site</p>
                    </div>
                </form>
            </div>

            {if ($category eq 1) }
                <div id="map-canvas" style="min-width: 700px; min-height: 500px;margin:20px;"></div>
                <div class="clear"></div>
            {/if}
        </div>

            {if ($category eq 1) }
                {if ($results)}
                    <div class="carpatians" style="height:auto;">
                        <h3>Pages Find</h3>
                    </div>
                {/if}

                {foreach $results as $key => $data}
                    <div class="row" style="height:auto;">
                        <h4>{$key + 1}. {$data->title}</h4>

                        <div class="panel panel-default">
                            <div class="panel-heading"><a href="{Kohana::$base_url}pages/display/alias/{$data->alias}">
                                    {$data->description|truncate:500}</a></div>
                            <div class="panel-body">
                                {$data->description|truncate:500}
                            </div>
                        </div>
                    </div>
                {/foreach}
            {/if}

    </div>
{/block}

{block name="jscode"}
{/block}


