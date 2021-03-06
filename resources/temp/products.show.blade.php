@foreach($images as $img)

				{{ asset($img) }}
				<?php echo '<br>' ?>

			@endforeach

			<?php echo '<br><br>' ?>

			@foreach($thumbs as $thumb)

				<?php echo '<br>' ?>
				{{ asset($thumb) }}

			@endforeach

			@for($i=0; $i<count($images); $i++)

				<?php echo '<hr>'; ?>

				{{ asset($images[$i]) }}
				<?php echo '<br>' ?>
				{{ asset($thumbs[$i]) }}

			@endfor


			@if($images != null)
				<div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 800px; height: 456px; overflow: hidden; visibility: hidden; background-color: #24262e;">
				<!-- Loading Screen -->
				<div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
				    <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
				     <div style="position:absolute;display:block;background:url({{ asset(public_path('/images/showslider/loading.gif'))  }}) no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
				</div>
				<div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 800px; height: 356px; overflow: hidden;">
				@for($i=0; $i<count($images); $i++)
				    <div data-p="144.50">
				        <img data-u="image" src="{{ asset($images[$i]) }}" />
				        <img data-u="thumb" src="{{ asset($thumbs[$i]) }}" />
				    </div>
				@endfor
				</div>
				<!-- Thumbnail Navigator -->
				<div data-u="thumbnavigator" class="jssort01" style="position:absolute;left:0px;bottom:0px;width:800px;height:100px;" data-autocenter="1">
				<!-- Thumbnail Item Skin Begin -->
				    <div data-u="slides" style="cursor: default;">
				        <div data-u="prototype" class="p">
				            <div class="w">
				                <div data-u="thumbnailtemplate" class="t"></div>
				            </div>
				        	<div class="c"></div>
				        </div>
				    </div>
				            <!-- Thumbnail Item Skin End -->
				</div>
				        <!-- Arrow Navigator -->
				<span data-u="arrowleft" class="jssora05l" style="top:158px;left:8px;width:40px;height:40px;"></span>
				<span data-u="arrowright" class="jssora05r" style="top:158px;right:8px;width:40px;height:40px;"></span>
				</div>
			@endif