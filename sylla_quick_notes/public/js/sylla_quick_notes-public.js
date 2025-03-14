(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	// add note
	$(document).on('submit', '#sylla_quick_notes_form', function(event) {
		event.preventDefault();

		// Store reference to the form
		let form = this; 
		let formData = new FormData(form);
		formData.append('action', 'sylla_save_note');

		$.ajax({
			url: sylla_data.ajaxurl,
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			success: function(response) {		
				if (response.success) {
					const accordion = $('#notesAccordion');
					if (accordion.length) {
						const noteTitle = $('#sylla_note_title').val();
						const noteContent = $('#sylla_note_content').val();
						const lastIndex = accordion.children().length;
						const newNoteId = response.data.note_id;
						const newNote = `<div class="accordion-item">
												<h2 class="accordion-header" id="heading${lastIndex + 1}">
													<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${lastIndex + 1}" aria-expanded="true" aria-controls="collapse${lastIndex + 1}">
														${noteTitle}
													</button>
												</h2>
												<div id="collapse${lastIndex + 1}" class="accordion-collapse collapse" aria-labelledby="heading${lastIndex + 1}" data-bs-parent="#notesAccordion">
													<div class="accordion-body">
														${noteContent}
														<div class="mt-3">
															<button class="btn btn-danger sylla_delete_note" data-note-id="${newNoteId}">
																${sylla_data.localizeDeleteNote}
															</button>
														</div>
													</div>
												</div>
											</div>`;
						accordion.append(newNote);
						// clear form
						form.reset();
					}
				}
			},
			error: function(xhr, status, error) {
				console.error('Error saving note:', error);
			}
		});
	});

	// delete note
	$(document).on('click', '.sylla_delete_note', function(event) {
		event.preventDefault();

		const security = $('#sylla_security_accordeon').val();
		const noteId = $(this).data('note-id');
		let data = {
			action: 'sylla_delete_note',
			sylla_security_accordeon: security,
			sylla_note_id: noteId
		};

		$.ajax({
			url: sylla_data.ajaxurl,
			type: 'POST',
			data: data,
			success: function(response) {
				if (response.success) {
					// remove note from accordion
					$(`.sylla_delete_note[data-note-id="${noteId}"]`).closest('.accordion-item').remove();
				}
			},
			error: function(xhr, status, error) {
				console.error('Error deleting note:', error);
			}
		});
	});

})( jQuery );
