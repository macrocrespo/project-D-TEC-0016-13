var allEditors = document.querySelectorAll('.editor');
for (var i = 0; i < allEditors.length; ++i) {

	ClassicEditor.create( allEditors[i], {
		toolbar: {
			items: [
				'heading',
				'|',
				'bold',
				'italic',
				'underline',
				'removeFormat',
				'|',
				'subscript',
				'superscript',
				'|',
				'alignment',
				'indent',
				'outdent',
				'|',
				'blockQuote',
				'link',
				'bulletedList',
				'numberedList',
				'|',
				'undo',
				'redo'
			]
		}
	} );
}