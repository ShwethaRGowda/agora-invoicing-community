@extends('themes.default1.layouts.master')
@section('content')
<div class="box box-primary">

    <div class="box-header">
        @if($user!='')
        {!! Form::open(['url'=>'generate/invoice/'.$user->id,'id'=>'formoid']) !!}
        <input type="hidden" name="user" value="{{$user->id}}">
        <h4>{{ucfirst($user->first_name)}} {{ucfirst($user->last_name)}}, ({{$user->email}}) </h4>
        @else 
        {!! Form::open(['url'=>'generate/invoice','id'=>'formoid']) !!}
        <h4>Place Order</h4>
        @endif
        {!! Form::submit(Lang::get('message.generate'),['class'=>'btn btn-primary pull-right'])!!}
    </div>

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div id="error">
    </div>
    <div id="success">
    </div>
    <div id="fails">
    </div>
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissable">
        <i class="fa fa-ban"></i>
        <b>{{Lang::get('message.alert')}}!</b> {{Lang::get('message.success')}}.
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{Session::get('success')}}
    </div>
    @endif
    <!-- fail message -->
    @if(Session::has('fails'))
    <div class="alert alert-danger alert-dismissable">
        <i class="fa fa-ban"></i>
        <b>{{Lang::get('message.alert')}}!</b> {{Lang::get('message.failed')}}.
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{Session::get('fails')}}
    </div>
    @endif


    <div class="box-body">
        <div class="row">

            <div class="col-md-12">

                @if($user=='')
                <?php
                $users = \App\User::lists('email', 'id')->toArray();
                ?>
                <div class="col-md-4 form-group">
                    {!! Form::label('user',Lang::get('message.clients')) !!}
                    {!! Form::select('user',[''=>'Select','Users'=>$users],null,['class'=>'form-control','id'=>'user']) !!}
                </div>
                @endif

                <div class="col-md-4 form-group">
                    {!! Form::label('product',Lang::get('message.product'),['class'=>'required']) !!}
                    {!! Form::select('product',[''=>'Select','Products'=>$products],null,['class'=>'form-control','onChange'=>'getPrice(this.value);']) !!}
                </div>
                <div id="fields">
                </div>

                <div class="col-md-4 form-group">
                    {!! Form::label('price',Lang::get('message.price')) !!}
                    {!! Form::text('price',null,['class'=>'form-control']) !!}
                </div>
                <div class="col-md-4 form-group">
                    {!! Form::label('code',Lang::get('message.promotion-code')) !!}
                    {!! Form::text('code',null,['class'=>'form-control']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::label('send_mail',Lang::get('message.send-mail')) !!}
                    <p>{!! Form::checkbox('client',1) !!} To Client&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!! Form::checkbox('agent',1) !!} To Agent</p>
                </div>




            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>

</div>

</div>

<script>
    function getPrice(val) {
        var user = document.getElementsByName('user')[0].value;


        $.ajax({
            type: "POST",
            url: "{{url('get-price')}}",
            data: {'product': val, 'user': user},
            //data: 'product=' + val+'user='+user,
            success: function (data) {
                var price = data['price'];
                var field = data['field'];
                //console.log(field);
                $("#price").val(price);
                $("#fields").append(field);
            }
        });
    }

</script>
<script type='text/javascript'>
    /* attach a submit handler to the form */
    $("#formoid").submit(function (event) {
        /* stop form from submitting normally */
        event.preventDefault();

        /* get the action attribute from the <form action=""> element */
        var $form = $(this),
                url = $form.attr('action');
        if ($('#domain').length > 0) {
            var domain = document.getElementsByName('domain')[0].value;
            var data = $("#formoid").serialize() + '&domain=' + domain;
            if ($('#quantity').length > 0) {
                var quantity = document.getElementsByName('quantity')[0].value;
                var data = $("#formoid").serialize() + '&domain=' + domain + '&quantity=' + quantity;
            }else{
                var data = $("#formoid").serialize() + '&domain=' + domain;
            }
        } else {
            if ($('#quantity').length > 0) {
                var quantity = document.getElementsByName('quantity')[0].value;
                var data = $("#formoid").serialize() + '&quantity=' + quantity;
            } else {
                var data = $("#formoid").serialize();
            }
        }

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function (data) {
                //var response = JSON.stringify(data.result);
                for (key in data.result) {
                    if (key == 'success') {

                        $('#success').append('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + data.result[key] + '</div>');
                        //$('#success').remove();
                    }
                    if (key == 'fails') {
                        // $('#fails').remove();
                        $('#fails').append('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + data.result[key] + '</div>');
                    }

                }
            },
            error: function (data) {
                var response = JSON.parse(data.responseText);
                $.each(response, function (k, v) {

                    $('#error').append('<div class="alert alert-danger"><strong>Whoops!</strong> There were some problems with your input.<br><br><ul><li>' + v + '</li></ul></div>');
                    // $('#error').remove();
                });
            }
        });

        //console.log(data);
        /* Send the data using post with element id name and name2*/
//      var posting = $.post(url,data);
//
//      /* Alerts the results */
//      posting.done(function( data ) {
//        console.log(data);
//      });
    });
</script>

@stop
