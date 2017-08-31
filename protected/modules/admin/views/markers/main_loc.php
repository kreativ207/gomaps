<div class="map_canvas" style="min-width: 200px; min-height: 300px; margin: 0 0 20px 0"></div>

<div>
    <div class="form">

        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'markers-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation'=>false,
        )); ?>

        <input data-name="google map adress" class="form-control map-form-control" type="search" placeholder="Type in an address" value="<?php echo $model->address ? $model->address : 'Kiev, Kyiv city, Ukraine';  ?>" id="geocomplete" name="geocomplete">
        <!--<label>Latitude</label>-->
        <input name="lat" type="hidden" value="<?php //echo $model->lat ? $model->lat : '';  ?>">

        <!--<label>Longitude</label>-->
        <input name="lng" type="hidden" value="<?php //echo $model->lng ? $model->lng : '';  ?>">

        <!--<label>Formatted Address</label>-->
        <input name="formatted_address" type="hidden" value="">

        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php //echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model,'name'); ?>
            <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>60)); ?>
            <?php echo $form->error($model,'name'); ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->

    <div class="col-md-2 box-find">
        <input id="find" type="button" value="Find" class="pull-right btn btn-primary btn-find" style="display: none"/>
    </div>
</div>

<?php
/* @var $this MarkersController */
/* @var $model Markers */
/* @var $form CActiveForm */
?>



<a id="reset" href="#" style="display:none;">Reset Marker</a>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBnrBH97YDkK-FKSJapMkPuvhXQyxPB8dw&language=en&region=USA&sensor=false&amp;libraries=places"></script>

<script>
    $(function(){
        $("#geocomplete").geocomplete({
            map: ".map_canvas",
            details: "form ",
            markerOptions: {
                draggable: true
            }
        });

        $("#geocomplete").bind("geocode:dragged", function(event, latLng){
            $("input[name=lat]").val(latLng.lat());
            $("input[name=lng]").val(latLng.lng());
            $("#reset").show();
        });


        $("#reset").click(function(){
            $("#geocomplete").geocomplete("resetMarker");
            $("#reset").hide();
            return false;
        });

        $("#find").click(function(){
            $("#geocomplete").trigger("geocode");
        }).click();
    });
</script>