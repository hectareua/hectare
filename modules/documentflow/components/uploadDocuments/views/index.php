<div class="box">
	<div id="drop-area">
		<label for="fileElem">
<!--			--><?//= $form->field($model, 'document')->fileInput(['options' => ['id' => 'fileElem','onchange="handleFiles(this.files)']]) ?>
			<input type="file" name="UserDocumentFlow[document]" id="fileElem" onchange="handleFiles(this.files)">
			<div class="uploadIcon">
				<i class="fa fa-upload fa-4x" aria-hidden="true"></i>
			</div>
			<div id="gallery"></div>
		</label>
	</div>
</div>