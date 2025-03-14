# Quick Notes WordPress Plugin Test Assignment

# Sylla Quick Notes Plugin

Add the `sylla_quick_notes` folder to the `plugins` folder.

Then go to the WordPress admin dashboard and activate the **Sylla Quick Notes** plugin.

---

## Hooks and Filters Documentation

### Filters

#### `sylla_shortcode_logged_status`
Filters the logged-in status for the shortcode.

- **Since:** 1.0.0  
- **Parameters:**
    - `bool $is_user_logged_in` - The logged-in status of the user.

---

#### `sylla_shortcode_not_logged_in_html`
Filters the HTML output for users who are not logged in.

- **Since:** 1.0.0  
- **Parameters:**
    - `string $html` - The HTML output for non-logged-in users.

---

* #### `sylla_shortcode_user_notes`
 * Filters the notes retrieved for the current user.
 *
 * - **Since:** 1.0.0  
 * - **Parameters:**
 *     - `array $notes` - The notes retrieved for the current user.
 *     - `int $current_user_id` - The ID of the current user.
 *

---

### Actions

#### `sylla_shortcode_logged_in_before`
Fires before the logged-in user's notes are displayed.

- **Since:** 1.0.0

---

#### `sylla_shortcode_logged_in_after`
Fires after the logged-in user's notes are displayed.

- **Since:** 1.0.0

---

#### `sylla_shortcode_create_node`
Fires when a new note is created.

- **Since:** 1.0.0  
- **Parameters:**
    - `string $note_title` - The title of the note.
    - `string $note_content` - The content of the note.
    - `int $user_id` - The ID of the user creating the note.

---

#### `sylla_shortcode_delete_node`
Fires when a note is deleted.

- **Since:** 1.0.0  
- **Parameters:**
    - `int $note_id` - The ID of the note being deleted.