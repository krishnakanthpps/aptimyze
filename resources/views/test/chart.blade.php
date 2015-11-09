@extends('layouts.master')

@section('content')

    <div id="chart"></div>

@endsection


@section('pagejquery')

    <script type="text/javascript">

//        var data = [ { x: 0, y: 40 }, { x: 1, y: 49 }, { x: 2, y: 17 }, { x: 3, y: 42 } ];
        {{--var data = {{$data}};--}}
        var graph = new Rickshaw.Graph.Ajax({
            element: document.querySelector("#chart"),
//            width: 580,
//            height: 250,
//            renderer: 'line',
{{--            dataURL: '{{url("/test/graph")}}',--}}
            dataURL: '{{url("json/1968363630_2.json")}}',
            onData: function (data) {
                return data;
            },
//            onData: function(d) { return d },
            onComplete: function(transport) {
                var graph = transport.graph;
//                var axes = new Rickshaw.Graph.Axis.Time( { graph: graph } );
                var detail = new Rickshaw.Graph.HoverDetail({ graph: graph });
            },
            series: [
                {
                    name: 'test',
                    {{--data:  {{$data}},--}}
                    color: '#ff5000',
                }
            ]
            /*series: [ {
             name: 'etest',
             color: 'steelblue'
             } ]*/
            /*onComplete: function () {
                // this is also where you can set up your axes and hover detail
                this.graph.render();
            }*/
        });
//        graph.render();

    </script>

@endsection