<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.linkedin.com/in/volodymyr-dhzychko-865348171/
 * @since      1.0.0
 *
 * @package    Sylla_quick_notes
 * @subpackage Sylla_quick_notes/public/partials
 */

// Load the text domain for localization.
load_plugin_textdomain( 'sylla-quick-notes', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="container mt-5">
    <h2><?php esc_html_e( 'Sylla Notes', 'sylla-quick-notes' ); ?></h2>
    <div class="table-responsive">
        <div class="accordion" id="notesAccordion">
            <?php wp_nonce_field( 'sylla_security_delete_note', 'sylla_security_accordeon' ); ?>
            <?php
            global $wpdb;
            $current_user_id = get_current_user_id();
            $table_name = $wpdb->prefix . 'sylla_quick_notes';
            $notes = apply_filters( 'sylla_shortcode_user_notes', $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE user_id = %d", $current_user_id ) ), $current_user_id );

            if ( $notes ) {
                foreach ( $notes as $index => $note ) {
                    ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading<?php echo $index; ?>">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $index; ?>" aria-expanded="true" aria-controls="collapse<?php echo $index; ?>">
                                <?php echo esc_html( $note->note_title ); ?>
                            </button>
                        </h2>
                        <div id="collapse<?php echo $index; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $index; ?>" data-bs-parent="#notesAccordion">
                            <div class="accordion-body">
                                <?php echo esc_html( $note->note_content ); ?>
                                <div class="mt-3">
                                    <button class="btn btn-danger sylla_delete_note" data-note-id="<?php echo esc_attr( $note->note_id ); ?>">
                                        <?php esc_html_e( 'Delete Note', 'sylla-quick-notes' ); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="accordion-item">
                    <div class="accordion-header">
                        <button class="accordion-button" type="button">
                            <?php esc_html_e( 'No notes', 'sylla-quick-notes' ); ?>
                        </button>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <h3 class="mt-4"><?php esc_html_e( 'Add Note', 'sylla-quick-notes' ); ?></h3>
    <form method="post" id="sylla_quick_notes_form">
        <?php wp_nonce_field( 'sylla_security_save_note', 'sylla_security_form' ); ?>
        <div class="mb-3">
            <label for="sylla_note_title" class="form-label"><?php esc_html_e( 'Note Title:', 'sylla-quick-notes' ); ?></label>
            <input type="text" class="form-control" name="sylla_note_title" id="sylla_note_title" placeholder="<?php esc_html_e( 'Enter your note title...', 'sylla-quick-notes' ); ?>">
        </div>
        
        <div class="mb-3">
            <label for="sylla_note_content" class="form-label"><?php esc_html_e( 'Note Content:', 'sylla-quick-notes' ); ?></label>
            <textarea class="form-control" name="sylla_note_content" id="sylla_note_content" rows="5" placeholder="<?php esc_html_e( 'Enter your note content...', 'sylla-quick-notes' ); ?>"></textarea>
        </div>
        
        <div class="mb-3">
            <input type="submit" class="btn btn-primary" value="<?php esc_html_e( 'Add Note', 'sylla-quick-notes' ); ?>">
        </div>
    </form>
</div>