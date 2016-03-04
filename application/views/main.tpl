{extends file="layout/index.tpl"}
{block name="content"}

    <input type="hidden" value="1"
           name="is_guest_allowed">

           
    <div class="col-md-1 pull-left">
            <div class="row btns">
                <a href="#" class="hide_left_block"><img src=" {$base_UI}img/hide_3.png"></a>
                <a href="#" class="show_left_block"><img src=" {$base_UI}img/hide.png"></a>
            </div>
        {foreach $services as $key => $item}
            <div class="row">
                <a href="#" id="a{$key + 1}" class="icon1" data-id="{$key + 1}" title="{$item->name}"></a>
            </div>

             
        {/foreach}


    </div>
     {foreach $services as $key => $item}
             

            <div class="block block_service{$key + 1}" data-id="{$key + 1}">
                {foreach $item->serviceChilds as $key2 => $item2}
                    {if $item2->view eq 1 }
                        <a href="#" class="serv_type" data-id="{$item2->idservice_type}" title="{$item2->name}"><img src="{$base_UI}img/{$item2->picture}"></a>
                    {/if}
                {/foreach}
            </div>
        {/foreach}
    {*<div class="block">
        <a href="#"><img src=" {$base_UI}img/hide.png"></a>
        <a href="#"><img src=" {$base_UI}img/hide.png"></a>
        <a href="#"><img src=" {$base_UI}img/hide_3.png"></a>
    </div>*}

    <div class="tab_icons pull-right">
                <a href="#" data-block="1" id="tab_icon1" class="btn_block1 show_sideblock active actived"><img src=" {$base_UI}img/map_icon.png"></a>
                <a href="#" data-block="2" id="tab_icon2" class="btn_block2 show_sideblock"><img src=" {$base_UI}img/sputnik.png"></a>
                <a href="#" data-block="3" id="tab_icon3" class="btn_block3 show_sideblock"><img src=" {$base_UI}img/book.png"></a>
                <a href="#" data-block="4" id="tab_icon4" class="btn_block4 show_sideblock"><img src=" {$base_UI}img/caculator.png"></a>
                <a href="#" data-block="5" id="tab_icon5" class="btn_block5 show_sideblock"><img src=" {$base_UI}img/image.png"></a>
                <a href="#" data-block="6" id="tab_icon6" class="btn_block6 show_sideblock"><img src=" {$base_UI}img/study.png"></a>
        </div>

    <div id="ajax_block" class="show_hide_block">
        <div class="col-md-4 col-md-content pull-right ">
            <div class="row header_block">
                <div class="col-md-8">
                    <img src=" {$base_UI}img/map_icon.png">
                    <p class="item"> &nbsp; Карта</p>
                </div>
                <div class="col-md-3 pull-right icons">
                    <a href="#" class="hide_sideblock hide_icon"><img src=" {$base_UI}img/hide.png"></a>
                    <a href="#" class="show_sideblock show_icon"><img src=" {$base_UI}img/hide_3.png"></a>
                    <a href="#" class="down_sideblock down_hide_icon"><img src=" {$base_UI}img/hide_2.png"></a>
                    <a href="#" class="up_sideblock up_show_icon"><img src=" {$base_UI}img/hide_4.png"></a>
                    <a href="#" class="close_icon"><img src=" {$base_UI}img/close.png"></a>
                </div>
            </div>

            <div class="ajax_content"></div>
            <div class="pages"></div>
        </div>
    </div>


    <div id="block1" data-block="1" class="show_hide_block active">
        <div class="col-xs-12 col-sm-5 col-md-4 col-md-content pull-right ">
            <div class="row header_block">
                <div class="col-xs-8 col-md-8">
                    <img src=" {$base_UI}img/map_icon.png">
                    <p class="item"> &nbsp; {__('Map')}</p>
                </div>
                <div class="col-xs-4 col-md-3 pull-right icons">
                    <a href="#" data-block="1" class="hide_sideblock hide_icon"><img src=" {$base_UI}img/hide.png"></a>
                    <a href="#" class="show_sideblock show_icon"><img src=" {$base_UI}img/hide_3.png"></a>
                    <a href="#" data-block="1" class="close_icon"><img src=" {$base_UI}img/close.png"></a>
                    <a href="#" class="down_sideblock down_hide_icon"><img src=" {$base_UI}img/hide_2.png"></a>
                    <a href="#" class="up_sideblock up_show_icon"><img src=" {$base_UI}img/hide_4.png"></a>
                </div>
            </div>    
            <div class="row content_block">
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#" class="catalog_transport"><img src=" {$base_UI}img/map_icon_1.png"></a>
                    <p>Каталог<br /> транспортных компаний</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/map_icon_2.png"></a>
                    <p>Каталог<br /> брокеров</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/map_icon_3.png"></a>
                    <p>Каталог<br /> Супорных компаний</p>
                </div>
            </div>
            <div class="row content_block">
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/map_icon_4.png"></a>
                    <p>Поиск свободной<br /> машины / контейнера</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/map_icon_5.png"></a>
                    <p>Поиск<br /> товара</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/map_icon_6.png"></a>
                    <p>Подать<br /> обьявление</p>
                </div>
            </div>
            <div class="row content_block">
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/map_icon_7.png"></a>
                    <p>Расчет<br /> доставки / страховки</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/map_icon_8.png"></a>
                    <p>Формирования<br /> маршрута</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                </div>
            </div>
        </div>
    </div>
    <div id="block2" data-block="2" class="show_hide_block">
        <div class="col-xs-12 col-sm-5 col-md-4 col-md-content pull-right ">
            <div class="row header_block">
                <div class="col-xs-8 col-md-8">
                    <img src=" {$base_UI}img/sputnik.png">
                    <p class="item"> &nbsp; {__('Track')}</p>
                </div>
                <div class="col-xs-4 col-md-3 pull-right icons">
                    <a href="#"  data-block="2" class="hide_sideblock hide_icon"><img src=" {$base_UI}img/hide.png"></a>
                    <a href="#" class="show_sideblock show_icon"><img src=" {$base_UI}img/hide_3.png"></a>
                    <a href="#"  data-block="2" class="close_icon"><img src=" {$base_UI}img/close.png"></a>
                    <a href="#" class="down_sideblock down_hide_icon"><img src=" {$base_UI}img/hide_2.png"></a>
                    <a href="#" class="up_sideblock up_show_icon"><img src=" {$base_UI}img/hide_4.png"></a>
                </div>
            </div>
            <div class="row content_block">
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/sp_icon_1.png"></a>
                    <p>Трекер контейнера</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/sp_icon_2.png"></a>
                    <p>Трекер Авиа</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/sp_icon_3.png"></a>
                    <p>Трекер курьера</p>
                </div>
            </div>
            <div class="row content_block">
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/sp_icon_4.png"></a>
                    <p>Трекер ж/д</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/sp_icon_5.png"></a>
                    <p>История поиска</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                </div>
            </div>
        </div>
    </div>


    <div id="block3" data-block="3" class="show_hide_block">
        <div class="col-xs-12 col-sm-5 col-md-4 col-md-content pull-right ">
            <div class="row header_block">
                <div class="col-xs-8 col-md-8">
                    <img src=" {$base_UI}img/book.png">
                    <p class="item"> &nbsp; {__('Directory')}</p>
                </div>
                <div class="col-xs-4 col-md-3 pull-right icons">
                    <a href="#"  data-block="3" class="hide_sideblock hide_icon"><img src=" {$base_UI}img/hide.png"></a>
                    <a href="#" class="show_sideblock show_icon"><img src=" {$base_UI}img/hide_3.png"></a>
                    <a href="#"  data-block="3" class="close_icon"><img src=" {$base_UI}img/close.png"></a>
                    <a href="#" class="down_sideblock down_hide_icon"><img src=" {$base_UI}img/hide_2.png"></a>
                    <a href="#" class="up_sideblock up_show_icon"><img src=" {$base_UI}img/hide_4.png"></a>
                </div>
            </div>    
            <div class="row content_block">
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                        <a href="##" data-block="3_1" class="submenu btn_block3_1"><img  src=" {$base_UI}img/spravochnik_icon_1.png"></a>
                        <p>Размеры<br /> морских контейнеров</p>
                    </div>
                    <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                        <a href="##" data-block="3_2" class="submenu btn_block3_2"><img src=" {$base_UI}img/spravochnik_icon_2.png"></a>
                        <p>Размеры палет</p>
                    </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="##" data-block="3_3"  class="submenu btn_block3_3" ><img src=" {$base_UI}img/spravochnik_icon_3.png"></a>
                    <p>ULD тип контейнеров</p>
                </div>
            </div>
            <div class="row content_block">
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="##" data-block="3_4" class="submenu btn_block3_4"><img src=" {$base_UI}img/spravochnik_icon_4.png"></a>
                    <p>Типы вагонов</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="##" data-block="3_5" class="submenu btn_block3_5"><img src=" {$base_UI}img/spravochnik_icon_5.png"></a>
                    <p>Таблица Инкотермс</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="##"><img src=" {$base_UI}img/spravochnik_icon_6.png"></a>
                    <p>Виды<br /> таможенных операций</p>
                </div>
            </div>
            <div class="row content_block">
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/spravochnik_icon_7.png"></a>
                    <p>Глоссарий</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/spravochnik_icon_8.png"></a>
                    <p>Классификация</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                </div>
            </div>
        </div>
    </div>


        <!-- Подкатегории -->
        <div id="block3_1"  data-block="3_1" class=" show_hide_block">
            <div class="col-xs-12 col-sm-9 col-md-8 col-md-content pull-right ">
                 <div class="row header_block">
                    <div class="col-xs-9 col-md-8">
                        <img src=" {$base_UI}img/spravochnik_icon_1.png">
                        <p class="item"> &nbsp; Размер морских контейнеров</p>
                    </div>
                    <div class="col-xs-3 col-md-3 pull-right icons_cat">
                        <a href="#contact" class="show_sideblock back_icon btn_block3"><img src=" {$base_UI}img/hide_3.png"></a>
                        <a href="#" class="hide_sideblock hide_icon"><img src=" {$base_UI}img/hide.png"></a>
                        <a href="#" class="show_sideblock show_icon"><img src=" {$base_UI}img/hide_3.png"></a>
                        <a href="#" data-block="3" class="close_icon"><img src=" {$base_UI}img/close.png"></a>
                    <a href="#" class="down_sideblock down_hide_icon"><img src=" {$base_UI}img/hide_2.png"></a>
                    <a href="#" class="up_sideblock up_show_icon"><img src=" {$base_UI}img/hide_4.png"></a>
                    </div>
                </div>
                <div class="row content_block">
                    <a href="#"><img src=" {$base_UI}img/foto_1.png"></a>
                    <a href="#"><img src=" {$base_UI}img/foto_1.png"></a>
                    <a href="#"><img src=" {$base_UI}img/foto_1.png"></a>
                    <a href="#"><img src=" {$base_UI}img/foto_1.png"></a>
                    <a href="#"><img src=" {$base_UI}img/foto_1.png"></a>
                    <a href="#"><img src=" {$base_UI}img/foto_1.png"></a>
                    <a href="#"><img src=" {$base_UI}img/foto_1.png"></a>
                    <a href="#"><img src=" {$base_UI}img/foto_1.png"></a>
                    <a href="#"><img src=" {$base_UI}img/foto_1.png"></a>
                    <a href="#"><img src=" {$base_UI}img/foto_1.png"></a>
                    <a href="#"><img src=" {$base_UI}img/foto_1.png"></a>
                    <a href="#"><img src=" {$base_UI}img/foto_1.png"></a>
                    <a href="#"><img src=" {$base_UI}img/foto_1.png"></a>
                    <a href="#"><img src=" {$base_UI}img/foto_1.png"></a>
                    <a href="#"><img src=" {$base_UI}img/foto_1.png"></a>
                </div>
                <!-- <img class="scroll" src=" {$base_UI}img/scroll.png">
                <img class="scroll_piptik" src=" {$base_UI}img/scroll_piptik.png"> -->
            </div>
        </div>

        <div id="block3_2" data-block="3_2" class=" show_hide_block ">
            <div class="col-xs-12 col-sm-9 col-md-8 col-md-content pull-right ">
                <div class="row header_block">
                    <div class="col-xs-8 col-md-8">
                        <img src=" {$base_UI}img/spravochnik_icon_2.png">
                        <p class="item"> &nbsp; Размер палет</p>
                    </div>
                    <div class="col-xs-4 col-md-3 pull-right icons_cat">
                        <a href="#contact" class="show_sideblock back_icon btn_block3"><img src=" {$base_UI}img/hide_3.png"></a>
                        <a href="#" class="hide_sideblock hide_icon"><img src=" {$base_UI}img/hide.png"></a>
                        <a href="#" class="show_sideblock show_icon"><img src=" {$base_UI}img/hide_3.png"></a>
                        <a href="#" data-block="3" class="close_icon"><img src=" {$base_UI}img/close.png"></a>
                    <a href="#" class="down_sideblock down_hide_icon"><img src=" {$base_UI}img/hide_2.png"></a>
                    <a href="#" class="up_sideblock up_show_icon"><img src=" {$base_UI}img/hide_4.png"></a>
                    </div>
                </div>
                <div class="row content_block">
                    <div class="col-md-3 text-center">
                        <div >
                            <p class="">Стандартный контейнер 40'</p>
                        </div>
                        <div >  
                            <a href="#"><img src=" {$base_UI}img/foto_2.png"></a>
                            <p class="">25 поддонов</p>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <p class="">Контейнер 40' расширенный до 2.5м</p>
                        <a href="#"><img src=" {$base_UI}img/foto_2.png"></a>
                        <p class="">30 поддонов</p>
                    </div>
                    <div class="col-md-3 text-center">
                        <p class="">Стандартный контейнер 45'</p>
                        <a href="#"><img src=" {$base_UI}img/foto_2.png"></a>
                        <p class="">27 поддонов</p>
                    </div>
                    <div class="col-md-3 text-center">
                        <p class="">Контейнер 45' расширенный до 2.5м</p>
                        <a href="#"><img src=" {$base_UI}img/foto_2.png"></a>
                        <p class="">33 поддонов</p>
                    </div>
                </div>
                
                
                <!-- <img class="scroll" src=" {$base_UI}img/scroll.png">
                <img class="scroll_piptik" src=" {$base_UI}img/scroll_piptik.png"> -->
            </div>
        </div>

        

        <div id="block3_3" data-block="3_3" class=" show_hide_block  ">
            <div class="col-xs-12 col-sm-7 col-md-6 col-md-content pull-right ">
                <div class="row header_block">
                    <div class="col-xs-8 col-md-8">
                        <img  src=" {$base_UI}img/spravochnik_icon_3.png">
                        <p class="item"> &nbsp; ULD тип контейнеров</p>
                    </div>
                    <div class="col-xs-4 col-md-3 pull-right icons_cat">
                       <a href="#contact" class="show_sideblock back_icon btn_block3"><img src=" {$base_UI}img/hide_3.png"></a>
                        <a href="#" class="hide_sideblock hide_icon"><img src=" {$base_UI}img/hide.png"></a>
                        <a href="#" class="show_sideblock show_icon"><img src=" {$base_UI}img/hide_3.png"></a>
                        <a href="#" data-block="3" class="close_icon"><img src=" {$base_UI}img/close.png"></a>
                    <a href="#" class="down_sideblock down_hide_icon"><img src=" {$base_UI}img/hide_2.png"></a>
                    <a href="#" class="up_sideblock up_show_icon"><img src=" {$base_UI}img/hide_4.png"></a>
                    </div>
                </div>
                <div class="row content_block">
                    <div class="col-xs-6 col-md-3 text-center">
                        <a href="#" class="btn_container"><img src=" {$base_UI}img/foto_3.png"></a>
                        <p>LD-1</p>
                        <ul>
                            <li><b>IATA ULD code</b>: AKC contoured container</li>
                            <li><b>Prefixes</b>: AVC, AVD, AVK, AVJ, and forkable AUV</li>
                            
                        </ul>
                    </div>
                    <div class="col-xs-6 col-md-3 text-center">
                        <a href="#" class="btn_container"><img src=" {$base_UI}img/foto_3.png"></a>
                        <p>LD-1</p>
                        <ul>
                            <li><b>IATA ULD code</b>: AKC contoured container</li>
                            <li><b>Prefixes</b>: AVC, AVD, AVK, AVJ, and forkable AUV</li>
                            
                        </ul>
                    </div>
                    <div class="col-xs-6 col-md-3 text-center">
                        <a href="#" class="btn_container"><img src=" {$base_UI}img/foto_3.png"></a>
                        <p>LD-1</p>
                        <ul>
                            <li><b>IATA ULD code</b>: AKC contoured container</li>
                            <li><b>Prefixes</b>: AVC, AVD, AVK, AVJ, and forkable AUV</li>
                            
                        </ul>
                    </div>
                    <div class="col-xs-6 col-md-3 text-center">
                        <a href="#" class="btn_container"><img src=" {$base_UI}img/foto_3.png"></a>
                        <p>LD-1</p>
                        <ul>
                            <li><b>IATA ULD code</b>: AKC contoured container</li>
                            <li><b>Prefixes</b>: AVC, AVD, AVK, AVJ, and forkable AUV</li>
                            
                        </ul>
                    </div>
                <!-- </div>
                <div class="row content_block"> -->
                    <div class="col-xs-6 col-md-3 text-center">
                        <a href="#" class="btn_container"><img src=" {$base_UI}img/foto_3.png"></a>
                        <p>LD-1</p>
                        <ul>
                            <li><b>IATA ULD code</b>: AKC contoured container</li>
                            <li><b>Prefixes</b>: AVC, AVD, AVK, AVJ, and forkable AUV</li>
                            
                        </ul>
                    </div>
                    <div class="col-xs-6 col-md-3 text-center">
                        <a href="#" class="btn_container"><img src=" {$base_UI}img/foto_3.png"></a>
                        <p>LD-1</p>
                        <ul>
                            <li><b>IATA ULD code</b>: AKC contoured container</li>
                            <li><b>Prefixes</b>: AVC, AVD, AVK, AVJ, and forkable AUV</li>
                            
                        </ul>
                    </div>
                    <div class="col-xs-6 col-md-3 text-center">
                        <a href="#" class="btn_container"><img src=" {$base_UI}img/foto_3.png"></a>
                        <p>LD-1</p>
                        <ul>
                            <li><b>IATA ULD code</b>: AKC contoured container</li>
                            <li><b>Prefixes</b>: AVC, AVD, AVK, AVJ, and forkable AUV</li>
                            
                        </ul>
                    </div>
                    <div class="col-xs-6 col-md-3 text-center">
                        <a href="#" class="btn_container"><img src=" {$base_UI}img/foto_3.png"></a>
                        <p>LD-1</p>
                        <ul>
                            <li><b>IATA ULD code</b>: AKC contoured container</li>
                            <li><b>Prefixes</b>: AVC, AVD, AVK, AVJ, and forkable AUV</li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div id="block3_4" data-block="3_4" class=" show_hide_block  ">
            <div class="col-xs-12 col-sm-8 col-md-7 col-md-content pull-right ">
                <div class="row header_block">
                    <div class="col-xs-8 col-md-8">
                        <img src=" {$base_UI}img/spravochnik_icon_4.png">
                        <p class="item"> &nbsp; Тип вагонов</p>
                    </div>
                    <div class="col-xs-4 col-md-3 pull-right icons_cat">
                       <a href="#contact" class="show_sideblock back_icon btn_block3"><img src=" {$base_UI}img/hide_3.png"></a>
                        <a href="#" class="hide_sideblock hide_icon"><img src=" {$base_UI}img/hide.png"></a>
                        <a href="#" class="show_sideblock show_icon"><img src=" {$base_UI}img/hide_3.png"></a>
                        <a href="#" data-block="3" class="close_icon"><img src=" {$base_UI}img/close.png"></a>
                    <a href="#" class="down_sideblock down_hide_icon"><img src=" {$base_UI}img/hide_2.png"></a>
                    <a href="#" class="up_sideblock up_show_icon"><img src=" {$base_UI}img/hide_4.png"></a>
                    </div>
                </div>
                <div class="row content_block">
                    <div class="col-xs-6 col-md-3 text-center">
                        <a href="#" class="btn_container"><img src=" {$base_UI}img/foto_4.png"></a>
                        <p>Four-axle covered wagon</p>
                        <ul>
                            <li>Loading capacity: 68 ton</li>
                            <li>Tare weight: 22.28 ton</li>
                            <li>Volume: 120 m3</li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-md-3 text-center">
                        <a href="#" class="btn_container"><img src=" {$base_UI}img/foto_4.png"></a>
                        <p>Four-axle covered wagon</p>
                        <ul>
                            <li>Loading capacity: 68 ton</li>
                            <li>Tare weight: 22.28 ton</li>
                            <li>Volume: 120 m3</li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-md-3 text-center">
                        <a href="#" class="btn_container"><img src=" {$base_UI}img/foto_4.png"></a>
                        <p>Four-axle covered wagon</p>
                        <ul>
                            <li>Loading capacity: 68 ton</li>
                            <li>Tare weight: 22.28 ton</li>
                            <li>Volume: 120 m3</li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-md-3 text-center">
                        <a href="#" class="btn_container"><img src=" {$base_UI}img/foto_4.png"></a>
                        <p>Four-axle covered wagon</p>
                        <ul>
                            <li>Loading capacity: 68 ton</li>
                            <li>Tare weight: 22.28 ton</li>
                            <li>Volume: 120 m3</li>
                        </ul>
                    </div>
                <!-- </div>
                <div class="row content_block"> -->
                    <div class="col-xs-6 col-md-3 text-center">
                        <a href="#" class="btn_container"><img src=" {$base_UI}img/foto_4.png"></a>
                        <p>Four-axle covered wagon</p>
                        <ul>
                            <li>Loading capacity: 68 ton</li>
                            <li>Tare weight: 22.28 ton</li>
                            <li>Volume: 120 m3</li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-md-3 text-center">
                        <a href="#" class="btn_container"><img src=" {$base_UI}img/foto_4.png"></a>
                        <p>Four-axle covered wagon</p>
                        <ul>
                            <li>Loading capacity: 68 ton</li>
                            <li>Tare weight: 22.28 ton</li>
                            <li>Volume: 120 m3</li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-md-3 text-center">
                        <a href="#" class="btn_container"><img src=" {$base_UI}img/foto_4.png"></a>
                        <p>Four-axle covered wagon</p>
                        <ul>
                            <li>Loading capacity: 68 ton</li>
                            <li>Tare weight: 22.28 ton</li>
                            <li>Volume: 120 m3</li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-md-3 text-center">
                        <a href="#" class="btn_container"><img src=" {$base_UI}img/foto_4.png"></a>
                        <p>Four-axle covered wagon</p>
                        <ul>
                            <li>Loading capacity: 68 ton</li>
                            <li>Tare weight: 22.28 ton</li>
                            <li>Volume: 120 m3</li>
                        </ul>
                    </div>
                <!-- </div>
                <div class="row content_block"> -->
                    <div class="col-xs-6 col-md-3 text-center">
                        <a href="#" class="btn_container"><img src=" {$base_UI}img/foto_4.png"></a>
                        <p>Four-axle covered wagon</p>
                        <ul>
                            <li>Loading capacity: 68 ton</li>
                            <li>Tare weight: 22.28 ton</li>
                            <li>Volume: 120 m3</li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-md-3 text-center">
                        <a href="#" class="btn_container"><img src=" {$base_UI}img/foto_4.png"></a>
                        <p>Four-axle covered wagon</p>
                        <ul>
                            <li>Loading capacity: 68 ton</li>
                            <li>Tare weight: 22.28 ton</li>
                            <li>Volume: 120 m3</li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-md-3 text-center">
                        <a href="#" class="btn_container"><img src=" {$base_UI}img/foto_4.png"></a>
                        <p>Four-axle covered wagon</p>
                        <ul>
                            <li>Loading capacity: 68 ton</li>
                            <li>Tare weight: 22.28 ton</li>
                            <li>Volume: 120 m3</li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-md-3 text-center">
                        <a href="#" class="btn_container"><img src=" {$base_UI}img/foto_4.png"></a>
                        <p>Four-axle covered wagon</p>
                        <ul>
                            <li>Loading capacity: 68 ton</li>
                            <li>Tare weight: 22.28 ton</li>
                            <li>Volume: 120 m3</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div id="block3_5" data-block="3_5" class=" show_hide_block ">
            <div class="col-xs-12 col-sm-7 col-md-6 col-md-content pull-right ">
                <div class="row header_block">
                    <div class="col-xs-8 col-md-8">
                        <img src=" {$base_UI}img/spravochnik_icon_5.png">
                        <p class="item"> &nbsp; Вибрать инкотермс</p>
                    </div>
                    <div class="col-xs-4 col-md-3 pull-right icons_cat">
                       <a href="#contact" class="show_sideblock back_icon btn_block3"><img src=" {$base_UI}img/hide_3.png"></a>
                        <a href="#" class="hide_sideblock hide_icon"><img src=" {$base_UI}img/hide.png"></a>
                        <a href="#" class="show_sideblock show_icon"><img src=" {$base_UI}img/hide_3.png"></a>
                        <a href="#" data-block="3" class="close_icon"><img src=" {$base_UI}img/close.png"></a>
                    <a href="#" class="down_sideblock down_hide_icon"><img src=" {$base_UI}img/hide_2.png"></a>
                    <a href="#" class="up_sideblock up_show_icon"><img src=" {$base_UI}img/hide_4.png"></a>
                    </div>
                </div>
                <div class="row content_block">
                        <img src=" {$base_UI}img/Ellipse_line_1.png">
                        <img src=" {$base_UI}img/foto_5.png">
                        <img src=" {$base_UI}img/foto_7.png">
                </div>
            </div>
        </div>


    <div id="block4" data-block="4" class="show_hide_block">
        <div class="col-xs-12 col-sm-5 col-md-4 col-md-content pull-right ">
            <div class="row header_block">
                <div class="col-xs-8 col-md-8">
                    <img src=" {$base_UI}img/caculator.png">
                    <p class="item"> &nbsp; {__('Calculator')}</p>
                </div>
                <div class="col-xs-4 col-md-3 pull-right icons">
                    <a href="#" data-block="4" class="hide_sideblock hide_icon"><img src=" {$base_UI}img/hide.png"></a>
                    <a href="#" class="show_sideblock show_icon"><img src=" {$base_UI}img/hide_4.png"></a>
                    <a href="#" data-block="4" class="close_icon"><img src=" {$base_UI}img/close.png"></a>
                    <a href="#" class="down_sideblock down_hide_icon"><img src=" {$base_UI}img/hide_2.png"></a>
                    <a href="#" class="up_sideblock up_show_icon"><img src=" {$base_UI}img/hide_4.png"></a>
                </div>
            </div>    
            <div class="row content_block">
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/kalk_icon_1.png"></a>
                    <p>Часовой пояс</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/kalk_icon_2.png"></a>
                    <p>Просчет груза</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/kalk_icon_3.png"></a>
                    <p>Перевод единиц</p>
                </div>
            </div>
            <div class="row content_block">
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/kalk_icon_4.png"></a>
                    <p>Курс валют</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/kalk_icon_5.png"></a>
                    <p>Растояние</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/kalk_icon_6.png"></a>
                    <p>Таможеный платеж</p>
                </div>
            </div>
        </div>
    </div>
    <div id="block5" data-block="5" class="show_hide_block">
        <div class="col-xs-12 col-sm-5 col-md-4 col-md-content pull-right ">
            <div class="row header_block">
                <div class="col-xs-8 col-md-8">
                    <img src=" {$base_UI}img/image.png">
                    <p class="item"> &nbsp; {__('Manufacturers')}</p>
                </div>
                <div class="col-xs-4 col-md-3 pull-right icons">
                    <a href="#" data-block="5" class="hide_sideblock hide_icon"><img src=" {$base_UI}img/hide.png"></a>
                    <a href="#" class="show_sideblock show_icon"><img src=" {$base_UI}img/hide_3.png"></a>
                    <a href="#" data-block="5" class="close_icon"><img src=" {$base_UI}img/close.png"></a>
                    <a href="#" class="down_sideblock down_hide_icon"><img src=" {$base_UI}img/hide_2.png"></a>
                    <a href="#" class="up_sideblock up_show_icon"><img src=" {$base_UI}img/hide_4.png"></a>
                </div>
            </div>    
            <div class="row content_block">
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/proiz_icon_1.png"></a>
                    <p>Поиск по производителях и товарах</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/proiz_icon_2.png"></a>
                    <p>Полезные ископаемые</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/proiz_icon_3.png"></a>
                    <p>Агро</p>
                </div>
            </div>
            <div class="row content_block">
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/proiz_icon_4.png"></a>
                    <p>Металл</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/proiz_icon_5.png"></a>
                    <p>Дерево</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/proiz_icon_6.png"></a>
                    <p>Ввести собственное производство</p>
                </div>
            </div>
        </div>
    </div>
    <div id="block6" data-block="6" class="show_hide_block">
        <div class="col-xs-12 col-sm-5 col-md-4 col-md-content pull-right ">
            <div class="row header_block">
                <div class="col-xs-8 col-md-8">
                    <img src=" {$base_UI}img/study.png">
                    <p class="item"> &nbsp; {__('Training')}</p>
                </div>
                <div class="col-xs-4 col-md-3 pull-right icons">
                    <a href="#" data-block="6" class="hide_sideblock hide_icon"><img src=" {$base_UI}img/hide.png"></a>
                    <a href="#" class="show_sideblock show_icon"><img src=" {$base_UI}img/hide_3.png"></a>
                    <a href="#" data-block="6" class="close_icon"><img src=" {$base_UI}img/close.png"></a>
                    <a href="#" class="down_sideblock down_hide_icon"><img src=" {$base_UI}img/hide_2.png"></a>
                    <a href="#" class="up_sideblock up_show_icon"><img src=" {$base_UI}img/hide_4.png"></a>
                </div>
            </div>    
            <div class="row content_block">
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/ob_icon_1.png"></a>
                    <p>МБА обучение</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/ob_icon_2.png"></a>
                    <p>Правили Инкотермс</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/ob_icon_3.png"></a>
                    <p>Учебные карточки</p>
                </div>
            </div>
            <div class="row content_block">
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/ob_icon_4.png"></a>
                    <p>Тесты</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                    <a href="#"><img src=" {$base_UI}img/ob_icon_5.png"></a>
                    <p>Таможенные<br /> кодексы</p>
                </div>
                <div class="col-xs-4 col-sm-4  col-md-4 text-center">
                </div>
            </div>
        </div>
    </div>

{/block}

{block name="jscode"}
{/block}