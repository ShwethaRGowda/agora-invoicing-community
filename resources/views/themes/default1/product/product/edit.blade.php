@extends('themes.default1.layouts.master')
@section('content')
<div class="box box-primary">

    <div class="content-header">
        {!! Form::model($product,['url'=>'products/'.$product->id,'method'=>'patch','files' => true]) !!}
        <h4>{{Lang::get('message.product')}}	{!! Form::submit(Lang::get('message.save'),['class'=>'form-group btn btn-primary pull-right'])!!}</h4>

    </div>

    <div class="box-body">

        <div class="row">

            <div class="col-md-12">

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

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">{{Lang::get('message.details')}}</a></li>
                        <li><a href="#tab_2" data-toggle="tab">{{Lang::get('message.price')}}</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="row">

                                <div class="col-md-3 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <!-- first name -->
                                    {!! Form::label('name',Lang::get('message.name'),['class'=>'required']) !!}
                                    {!! Form::text('name',null,['class' => 'form-control']) !!}

                                </div>

                                <div class="col-md-3 form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                    <!-- last name -->
                                    {!! Form::label('type',Lang::get('message.type'),['class'=>'required']) !!}
                                    {!! Form::select('type',['Types'=>$type],null,['class' => 'form-control']) !!}

                                </div>

                                <div class="col-md-3 form-group {{ $errors->has('group') ? 'has-error' : '' }}">
                                    <!-- last name -->
                                    {!! Form::label('group',Lang::get('message.group')) !!}
                                    {!! Form::select('group',['Groups'=>$group],null,['class' => 'form-control']) !!}

                                </div>
                                <div class="col-md-3 form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                                    <!-- last name -->
                                    {!! Form::label('category',Lang::get('message.category')) !!}
                                    {!! Form::select('category',['product'=>'Product','addon'=>'Addon','service'=>'Service'],null,['class' => 'form-control']) !!}

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6 form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
                                    <script>
    tinymce.init({
    selector: 'textarea',
    plugins: "code",
    toolbar: "code",
    menubar: "tools"
});
</script>

                                    {!! Form::label('description',Lang::get('message.description')) !!}
                                    {!! Form::textarea('description',null,['class' => 'form-control','id'=>'textarea']) !!}




                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li>
                                            <div class="form-group {{ $errors->has('parent') ? 'has-error' : '' }}">
                                                <!-- last name -->
                                                {!! Form::label('parent',Lang::get('message.parent')) !!}
                                                {!! Form::select('parent[]',['Products'=>$products],null,['class' => 'form-control','multiple'=>'multiple']) !!}

                                            </div>
                                        </li>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <li>
                                                    <div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
                                                        <!-- first name -->
                                                        {!! Form::label('file',Lang::get('message.file')) !!}
                                                        {!! Form::file('file') !!}

                                                    </div>  
                                                </li>
                                                <li>
                                                    <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                                        <!-- last name -->
                                                        {!! Form::label('image',Lang::get('message.image')) !!}
                                                        {!! Form::file('image') !!}

                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group {{ $errors->has('version') ? 'has-error' : '' }}">
                                                        <!-- last name -->
                                                        {!! Form::label('version',Lang::get('message.version')) !!}
                                                        {!! Form::text('version',null,['class'=>'form-control']) !!}

                                                    </div>
                                                </li>
                                            </div>
                                            <div class="col-md-2">
                                                <p>
                                                    <b>OR</b>
                                                </p>
                                            </div>
                                            <div class="col-md-5">
                                                <li>
                                                    <div class="form-group {{ $errors->has('github_owner') ? 'has-error' : '' }}">
                                                        <!-- first name -->
                                                        {!! Form::label('github_owner',Lang::get('message.github-owner')) !!}
                                                        {!! Form::text('github_owner',null,['class'=>'form-control']) !!}

                                                    </div>  
                                                </li>
                                                <li>
                                                    <div class="form-group {{ $errors->has('github_repository') ? 'has-error' : '' }}">
                                                        <!-- last name -->
                                                        {!! Form::label('github_repository',Lang::get('message.github-repository-name')) !!}
                                                        {!! Form::text('github_repository',null,['class'=>'form-control']) !!}

                                                    </div>
                                                </li>
                                            </div>
                                        </div>

                                        <li>
                                            <div class="form-group {{ $errors->has('require_domain') ? 'has-error' : '' }}">
                                                <!-- last name -->
                                                {!! Form::label('require_domain',Lang::get('message.require_domain')) !!}
                                                {!! Form::hidden('require_domain', 0) !!}
                                                <p>{!! Form::checkbox('require_domain',1) !!} {{Lang::get('message.tick-to-show-domain-registration-options')}}</p>

                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group {{ $errors->has('shoping_cart_link') ? 'has-error' : '' }}">
                                                <!-- last name -->
                                                {!! Form::label('shoping_cart_link',Lang::get('message.shoping-cart-link')) !!}
                                                {!! Form::text('shoping_cart_link',null,['class'=>'form-control']) !!}

                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li>
                                            <div class="form-group {{ $errors->has('stock_control') ? 'has-error' : '' }}">
                                                <!-- first name -->
                                                {!! Form::label('stock_control',Lang::get('message.stock_control')) !!}
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        {!! Form::hidden('stock_control', 0) !!}
                                                        <p>{!! Form::checkbox('stock_control',1) !!}     {{Lang::get('message.enable-quantity-in-stock')}}       
                                                            {!! Form::text('stock_qty',null) !!} </p>
                                                    </div>
                                                    <!--                                        <div class="col-md-3">
                                                                                                {!! Form::text('stock_qty',null,['class'=>'form-control']) !!}
                                                                                            </div>-->

                                                </div>
                                        </li>
                                        <li>
                                            <div class="row">

                                                <div class="col-md-4 form-group {{ $errors->has('sort_order') ? 'has-error' : '' }}">
                                                    <!-- first name -->
                                                    {!! Form::label('sort_order',Lang::get('message.sort_order')) !!}
                                                    {!! Form::text('sort_order',null,['class'=>'form-control']) !!}

                                                </div>

                                                <div class="col-md-8 form-group {{ $errors->has('tax_apply') ? 'has-error' : '' }}">
                                                    <!-- last name -->
                                                    {!! Form::label('tax_apply',Lang::get('message.apply_tax')) !!}
                                                    {!! Form::hidden('tax_apply', 0) !!}
                                                    <p>{!! Form::checkbox('tax_apply',1) !!}  {{Lang::get('message.tick-this-box-to-charge-tax-for-this-product')}}</p>

                                                </div>

                                            </div>
                                        </li>


                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li>
                                            <div class="form-group {{ $errors->has('hidden') ? 'has-error' : '' }}">
                                                <!-- first name -->
                                                {!! Form::label('hidden',Lang::get('message.hidden')) !!}
                                                {!! Form::hidden('hidden', 0) !!}
                                                <p>{!! Form::checkbox('hidden',1) !!}  {{Lang::get('message.tick-to-hide-from-order-form')}}</p>

                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group {{ $errors->has('retired') ? 'has-error' : '' }}">
                                                <!-- first name -->
                                                {!! Form::label('retired',Lang::get('message.retired')) !!}
                                                {!! Form::hidden('retired', 0) !!}
                                                <p>{!! Form::checkbox('retired',1) !!}  {{Lang::get('message.tick-to-hide-from-admin-area-product-dropdown-menus')}}</p>

                                            </div>  
                                        </li>
                                        

                                    </ul>
                                </div>

                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <table class="table table-responsive">

                                <tr>
                                    <td><b>{!! Form::label('subscription',Lang::get('message.subscription')) !!}</b></td>
                                    <td>
                                        <div class="form-group {{ $errors->has('subscription') ? 'has-error' : '' }}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    @if($price->first())
                                                    {!! Form::select('subscription',[''=>'Select','Subscription'=>$subscription],$price->first()->subscription,['class'=>'form-control']) !!}
                                                    @else 
                                                    {!! Form::select('subscription',[''=>'Select','Subscription'=>$subscription],null,['class'=>'form-control']) !!}
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::hidden('deny_after_subscription',0) !!}
                                                    {!! Form::checkbox('deny_after_subscription',1) !!}
                                                    {!! Form::label('deny_after_subscription',Lang::get('message.deny_after_subscription')) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td><b>{!! Form::label('currency',Lang::get('message.currency')) !!}</b></td>
                                    <td>

                                        <table class="table table-responsive">
                                            <tr>
                                                <th></th>
                                                <th>{{Lang::get('message.regular-price')}}</th>
                                                <th>{{Lang::get('message.sales-price')}}</th>
                                            </tr>

                                            @foreach($currency as $key=>$value)
                                            <tr>
                                                <td>

                                                    <input type="hidden" name="currency[{{$key}}]" value="{{$key}}">
                                                    <p>{{$value}}</p>

                                                </td>

                                                <td>

                                                    {!! Form::text('price['.$key.']',$regular[$key]) !!}

                                                </td>
                                                <td>

                                                    {!! Form::text('sales_price['.$key.']',$sales[$key]) !!}

                                                </td>
                                            </tr>
                                            @endforeach


                                        </table>

                                    </td>
                                </tr>




                                <tr>
                                    <td><b>{!! Form::label('multiple_qty',Lang::get('message.allow-multiple-quantities')) !!}</b></td>
                                    <td>
                                        <div class="form-group {{ $errors->has('multiple_qty') ? 'has-error' : '' }}">
                                            <?php
                                            if ($product) {
                                                $multiple = $product->multiple_qty;
                                                if ($multiple == 1) {
                                                    $value = true;
                                                } else {
                                                    $value = '';
                                                }
                                            } else {
                                                $value = '';
                                            }
                                            //dd($multiple);
                                            ?>

                                            <p>{!! Form::checkbox('multiple_qty',1,$value) !!}  {{Lang::get('message.tick-this-box-to-allow-customers-to-specify-if-they-want-more-than-1-of-this-item-when-ordering')}} </p>

                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td><b>{!! Form::label('auto-terminate',Lang::get('message.auto-terminate')) !!}</b></td>
                                    <td>
                                        <div class="form-group {{ $errors->has('auto_terminate') ? 'has-error' : '' }}">

                                            <p>{!! Form::text('auto_terminate',null) !!} {{Lang::get('message.enter-the-number-of-days-after-activation-to-automatically-terminate')}}</p>

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>{!! Form::label('tax',Lang::get('message.taxes')) !!}</b></td>
                                    <td>
                                        <div class="form-group {{ $errors->has('taxes') ? 'has-error' : '' }}">
                                            <div class="row">
                                                <?php
                                                if (count($saved_taxes) > 0) {
                                                    foreach ($saved_taxes as $tax) {
                                                        $saved[$tax->tax_class_id] = 'true';
                                                    }
                                                }
                                                //dd($saved);
                                                ?>
                                                @forelse($taxes as $key=>$value)

                                                <div class="col-md-2">
                                                    @if(count($saved_taxes) > 0)
                                                    @if(key_exists($key,$saved))
                                                    <b>{{ucfirst($value)}} {!! Form::radio('tax',$key,$saved[$key]) !!}</b>
                                                    @else
                                                    <b>{{ucfirst($value)}} {!! Form::radio('tax',$key) !!}</b>
                                                    @endif
                                                    @else 
                                                    <b>{{ucfirst($value)}} {!! Form::radio('tax',$key) !!}</b>
                                                    @endif
                                                </div>
                                                @empty 
                                                <p>No taxes</p>
                                                @endforelse
                                            </div>

                                        </div>
                                    </td>
                                </tr>

                            </table>
                        </div>

                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->

            </div>


        </div>

    </div>

</div>

</div>


{!! Form::close() !!}
@stop