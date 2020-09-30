@php

    $post = App\Post::find(request()->post_id);
    
    if (!$post)
        exit();
@endphp

<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<body> 

<canvas id="currentPostChart" style="position: fixed;left: 0px;top: 0px;width: 100%;max-height: 100%;" width="100%" ></canvas>


</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script> 
    function setCurrentPostChart() { 
            var ctx = document.getElementById('currentPostChart').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',
                // The data for our dataset
                data: {
                    labels: [
                        @foreach($post->chart_data["x"] as $item)
                        '{{ $item }}',
                        @endforeach
                    ],
                    datasets: [{
                            label: '{{ __('mobile.avg_of_price') }} {{ $post->city->name_en }}',
                            backgroundColor: 'rgba(2, 169, 168, 0.5)',
                            borderColor: 'rgb(2, 150, 168)',
                            data: [ 
                                @foreach($post->chart_data["y"] as $item)
                                {{ $item }},
                                @endforeach
                            ]
                        }]
                },
                // Configuration options go here
                options: {}
            });
            
    }
    
    setCurrentPostChart();
</script>
</html> 





