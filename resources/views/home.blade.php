<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Home Page</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <style type="text/css">
            ul, #myUL {
                list-style-type: none;
            }
                #myUL {
                margin: 0;
                padding: 0;
            }
            .caret {
                cursor: pointer;
                -webkit-user-select: none; /* Safari 3.1+ */
                -moz-user-select: none; /* Firefox 2+ */
                -ms-user-select: none; /* IE 10+ */
                user-select: none;
            }
            .caret::before {
                content: "\25B6";
                color: black;
                display: inline-block;
                margin-right: 6px;
            }
            .caret-down::before {
                -ms-transform: rotate(90deg); /* IE 9 */
                -webkit-transform: rotate(90deg); /* Safari */'
                transform: rotate(90deg);
            }
            .nested {
                display: ;display: none;
            }
            .active {
                display: block;
            }
        </style>
    </head>
    <body class="antialiased bg-gray-100 ">
        <div class="block mx-6 mt-4" style="padding-bottom: 4px; align-content: center;">
            <a href="{{ route('/account/logout') }}">
                <button class="mx-6" style="float:right; padding: 0.5em; background-color:#B7EBBD"> Logout </button>
            </a>
        </div>
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen">
            <div class="bg-white p-6">
                <h1> <strong>Territories</strong> </h1>
                <span>Here are the list of territories:</span>
                    <?php
                        function createTerritoryList($parents, $places){
                            $list = "";
                            foreach($parents as $parent){
                                $list = $list . "<li>";
                                if(sizeof($places[$parent]['child']) > 0){
                                    $list = $list . "<span class='caret'>";
                                    $list = $list . $places[$parent]['name'];
                                    $list = $list . "</span>";
                                    $list = $list . "<ul class='nested'>";
                                    $list = $list . createTerritoryList($places[$parent]['child'], $places);
                                    $list = $list . "</ul>";
                                }else{
                                    $list = $list . $places[$parent]['name'];
                                }
                                $list = $list . "</li>";
                            }
                            return $list;
                        }

                        echo '<ul id="territories">';
                        echo createTerritoryList($parents, $places);
                        echo '</ul>';
                    ?>
            </div>
        </div>
    </body>
</html>
