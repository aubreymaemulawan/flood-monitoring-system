<?php 
    $cnt = count($water_level);
?>
@foreach($water_level as $key=>$wl)
    @if($wl->device->status == 1)
    <tr>
        <td>{{$cnt--}}</td>
        <td>{{$wl->device->location}}</td>
        <td>{{$wl->height}} cm</td>
        <!-- Status column -->
        @if ($wl->color == 'red')
        <td><span class="badge rounded-pill bg-danger">Extreme</span></td>
        @elseif ($wl->color == 'orange')
        <td><span style="background-color:orange;color:white" class="badge rounded-pill">Severe</span></td>
        @elseif ($wl->color == 'green')
        <td><span class="badge rounded-pill bg-success">Above Normal</span></td>
        @endif
        <td>
            <?php
                $date = new DateTime($wl->created_at);
                $result = $date->format('g:i:s a');
            ?>
            @if($wl->created_at != null)
                {{$result}}
            @else
                N/A
            @endif
        </td>
    </tr>
    @endif
@endforeach





