## What and Why?

This is an extension to add shortcodes for Event Tickets.

## How?

You can basically add shortcodes to pages and posts or any custom post type. This plugin includes three shortcodes:

* `[tribe_tickets]`
* `[tribe_tickets_rsvp]`
* `[tribe_tickets_attendees]`

### Tribe Tickets shortcode

The shortcode includes the tickets block. It has one required parameter, the `post_id`. The `post_id` parameter is the ID of the event (post or page, depending on your site configuration) where the tickets were created.

*Example usage:*

```
[tribe_tickets post_id="123"]
```

_Where 123 is the ID of the post/page/event where the tickets were created_

### Tribe Tickets RSVP shortcode

The shortcode includes the RSVP block. It has one required parameter, the `post_id`. The `post_id` parameter is the ID of the event (post or page, depending on your site configuration) where the RSVP was created.

*Example usage:*

```
[tribe_tickets_rsvp post_id="123"]
```

_Where 123 is the ID of the post/page/event where the tickets were created_

### Tribe Tickets Attendees shortcode

The shortcode includes the RSVP block. It has two parameters.

* `post_id` - This is a required parameter, the `post_id`. The `post_id` parameter is the ID of the event (post or page, depending on your site configuration) of which you want to display the attendees.
* `title` - This one is optional, it'll set the title of the block in the HTML.

*Example usage:*

```
[tribe_tickets_attendees post_id="123" title="These fine folks are coming to my event"]
```

_Where 123 is the ID of the post/page/event the attendees will come from_