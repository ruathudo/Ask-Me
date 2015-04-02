@extends('template_masterpage') 



@section('content') 

<h1>{{$title}}</h1> 

@if(count($questions)) 



@foreach($questions as $question) 



<?php 

            //Question's asker and tags info 

$asker = $question->users; 

$tags = $question->tags;                 

?> 



<div class="qwrap questions"> 
      <div class="row">
	{{-- Guests cannot see the vote arrows --}} 
            <div class="container">
	@if(Sentry::check()) 

	<div class="arrowbox well col-sm-1 col-md-1 col-lg-1"> 
		{{HTML::linkRoute('vote','',array('up',   

			$question->id),array('class'=>'glyphicon glyphicon-thumbs-up',   

			'title'=>'Upvote'))}} 
            <br>
		{{HTML::linkRoute('vote','',array('down',  

			$question->id),array('class'=>'glyphicon glyphicon-thumbs-down',  

			'title'=>'Downvote'))}} 

	</div> 

	@endif 



		{{-- class will differ on the situation --}} 

		@if($question->votes > 0) 

		<div class="cntbox"> 

			@elseif($question->votes == 0) 

			<div class="cntbox well cntgreen col-sm-1 col-md-1 col-lg-1"> 

				@else 

				<div class="cntbox cntred"> 

					@endif 

					<div class="cntcount">{{$question->votes}}</div> 

					<div class="cnttext">vote</div> 

				</div> 



            {{--Answer section will be filled later in this   

            chapter--}} 

            <div class="cntbox well col-sm-1 col-md-1 col-lg-1"> 

            	<div class="cntcount">0</div> 

            	<div class="cnttext">answer</div> 

            </div> 



            <div class="qtext col-sm-8 col-md-8 col-lg-8"> 

            	<div class="qhead"> 

            		{{HTML::linkRoute('question_details',  

            			$question->title,array($question->id,  

            			Str::slug($question->title)))}} 

            		</div> 

            		<div class="qinfo">Asked by <a href="#">  

            			{{$asker->first_name.' '.$asker->last_name}}</a>   

            			around {{date('m/d/Y H:i:s',  

            			strtotime($question->created_at))}}</div> 

            			@if($tags!=null) 

            			<ul class="qtagul"> 

            				@foreach($tags as $tag) 

            				<li>{{HTML::linkRoute('tagged',$tag->tag,  

            				$tag->tagFriendly)}}</li> 

            				@endforeach 

            			</ul> 
            			

            			@endif 
                        </div>
            		</div> {{-- end of row --}}
                        </div>
            	</div> 

            	@endforeach 



            	{{-- and lastly, the pagination --}} 

            	{{$questions->links()}} 



            	@else 

            	No questions found. {{HTML::linkRoute('ask',  

            	'Ask a question?')}} 

            	@endif 



            	@stop 