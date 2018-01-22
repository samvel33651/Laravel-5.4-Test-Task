@extends('layouts.app')


@section('content')
    <div class="row text-center placeholders"  style="margin-bottom: 25px;">
        <div class="col-6 col-sm-6 placeholder" style="border: 1px solid rgba(51, 51, 51, 0.27)">
            <div class="row" style="margin-bottom:10px; border-bottom: 2px solid rgba(51, 51, 51, 0.27); padding: 10px; ">
                <div class="col-6 col-sm-6 placeholder">
                    <i class="fa fa-cubes fa-5x" aria-hidden="true"></i>
                    <h4>Items number </h4>
                    <div class="text-muted"><h1>{{$itemsCount}}</h1></div>
                </div>
                <div class="col-6 col-sm-6 placeholder">
                    <i class="fa fa-money fa-5x" aria-hidden="true"></i>
                    <h4>Average Items Price</h4>
                    <span class="text-muted"><h1>${{$averageItemsPrice}}</h1></span>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-sm-6 placeholder">
                    <i class="fa fa-user fa-5x" aria-hidden="true"></i>
                    <h4>Active users</h4>
                    <span class="text-muted"><h1>{{$activeUsersCount}}</h1></span>

                </div>
                <div class="col-6 col-sm-6 placeholder">
                    <i class="fa fa-file-o fa-5x" aria-hidden="true"></i>
                    <h4>Types</h4>
                    <span class="text-muted"><h1>{{$typesCount}}</h1></span>
                </div>
            </div>

        </div>
        <div class="col-6 col-sm-6 placeholder" style="padding: 0px;">
            <div id="chartContainer" style="height: 356px; width: 100%; border-top: 1px solid rgba(51, 51, 51, 0.27);
    border-bottom: 1px solid rgba(51, 51, 51, 0.27)"></div>
        </div>
    </div>
    <hr>
    <div class="row" style="margin-top: 25px;">

        <div class="newItems">
            @foreach($newItems->chunk(4) as $items)
                <div class="row">
                    @foreach($items as $item)
                        <div class="col-md-3">
                            <div class="thumbnail">
                                <img src="/img/uploads/items/{{$item->photo}}" alt="" class="img-responsive">
                                <div class="caption">
                                    <h4 class="pull-right">{{$item->item_name}}</h4>
                                    <h4>Model</h4>
                                </div>
                                <div class="caption">
                                    <h4 class="pull-right">{{$item->vendor()->value('name')}}</h4>
                                    <h4>Vendor</h4>
                                </div>
                                <div class="caption">
                                    <img src="/img/uploads/vendors/{{$item->vendor()->value('logo')}}" alt="" class="img-responsive">
                                </div>
                                <div class="caption">
                                    <h4 class="pull-right">${{$item->price}}</h4>
                                    <h4>Price</h4>
                                </div>
                                <div class="item">
                                    <div class="item-content-block tags">
                                        @foreach(explode(',', $item->tags) as $tag)
                                            <a>{{$tag}}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr>
            @endforeach

        </div>
    </div>


@endsection

@section('scripts')
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script></head>
    <script>

        window.onload = function () {
            var chartData = {!! json_encode($pieChartData) !!};
            var dataPoints = [];
            console.log(chartData);
            $.each(chartData, function (key, value) {
                if (key !== 'items') {
                    dataPoints.push({y: value, indexLabel: key});
                }
            });
            var chart = new CanvasJS.Chart("chartContainer",
                {
                    backgroundColor: "#f5f8fa",
                    theme: "theme2",
                    title: {
                        text: "Items in DB"
                    },
                    data: [
                        {
                            type: "pie",
                            showInLegend: true,
                            toolTipContent: "{y} - #percent %",
                            yValueFormatString: "",
                            legendText: "{indexLabel}",
                            dataPoints: dataPoints
                        }
                    ]
                });
            chart.render();
        }
    </script>
@endsection