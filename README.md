## What and Why?

This is an extension to add shortcodes for Event Tickets.

## How?

You can basically add shortcodes to pages and posts or any custom post type. This plugin includes five shortcodes:

* `[tribe_tickets]`
* `[tribe_tickets_rsvp]`
* `[tribe_tickets_attendees]`
* `[tribe_tickets_protected_content]`
* `[tribe_tickets_rsvp_protected_content]`

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

### Tribe Tickets Protected Content shortcode

The shortcode only shows the content if the currently logged in user is or isn't an attendee on the provided event. It supports HTML, text content, other shortcodes, oEmbeds, or any other useful content you might want.

It has three *optional parameters* available to customize how it works:

* `post_id` - This defaults to the current post ID. The ID of the event (post or page, depending on your site configuration) of which you want to check attendee status.
* `ticket_ids` - This defaults to attendees for _any ticket_. Provide a comma-separated list of Ticket IDs to limit the attendee status check for.
* `not_ticket_ids` - This defaults as empty. Provide a comma-separated list of Ticket IDs to exclude on the attendee status check for. _Note: This will ensure that only attendees who have purchased other tickets will be returned._
* `ticketed` - This defaults to `1` which means the shortcode will always check that the user **IS an attendee** before showing the content. Set this to `0` to check that the user **IS NOT an attendee** before showing the content.

#### Example 1: Protected content based on any attendee for the *current* event

```
[tribe_tickets_protected_content]
This content will only show to attendees of the current event this shortcode is embedded on.
[/tribe_tickets_protected_content]
```

#### Example 2: Protected content based on any attendee for a specific event

```
[tribe_tickets_protected_content post_id="123"]
This content will only show to attendees of the event (ID: 123).
[/tribe_tickets_protected_content]
```

_Where 123 is the ID of the post/page/event where the tickets were created_

#### Example 3: Protected content based on attendees for specific tickets on a specific event

```
[tribe_tickets_protected_content post_id="123" ticket_ids="32,50,90"]
This content will only show to attendees of the event (ID: 123) who have purchased certain tickets (IDs: 32, 50, or 90).
[/tribe_tickets_protected_content]
```

_Where 123 is the ID of the post/page/event where the tickets were created_

#### Example 4: Protected content based on any NON-attendee for the *current* event

```
[tribe_tickets_protected_content ticketed="0"]
This content will only show to people who are NOT attendees of the current event this shortcode is embedded on.
[/tribe_tickets_protected_content]
```

_Where 123 is the ID of the post/page/event where the tickets were created_

#### Example 5: Protected content based on any NON-attendee for a specific event

```
[tribe_tickets_protected_content post_id="123" ticketed="0"]
This content will only show to people who are NOT attendees of the event (ID: 123).
[/tribe_tickets_protected_content]
```

_Where 123 is the ID of the post/page/event where the tickets were created_

#### Example 6: Protected content based on NON-attendees for specific tickets on a specific event

```
[tribe_tickets_protected_content post_id="123" ticket_ids="32,50,90" ticketed="0"]
This content will only show to people who are NOT attendees of the event (ID: 123) who have NOT purchased certain tickets (IDs: 32, 50, or 90).
[/tribe_tickets_protected_content]
```

_Where 123 is the ID of the post/page/event where the tickets were created_


#### Example 7: Protected content for attendees on a specific event who are not an attendee of specific tickets

```
[tribe_tickets_protected_content post_id="123" not_ticket_ids="32,50,90"]
This content will only show to people who are attendees of the event (ID: 123) who have NOT purchased certain tickets (IDs: 32, 50, or 90).
[/tribe_tickets_protected_content]
```

_Where 123 is the ID of the post/page/event where the tickets were created_

#### Example 8: Protected content for attendees that shows up on event start date

```
[tribe_tickets_protected_content post_id="123" on="event_start_date"]
This content will only show to people who are attendees of the event (ID: 123) on/after the event start date.
[/tribe_tickets_protected_content]
```

_Where 123 is the ID of the post/page/event where the tickets were created_

#### Example 9: Protected content for attendees that shows up after a specific date

```
[tribe_tickets_protected_content post_id="123" on="2020-05-01 08:00:00"]
This content will only show to people who are attendees of the event (ID: 123) on/after May 1st, 2020 at 8am (according to the site timezone).
[/tribe_tickets_protected_content]
```

_Where 123 is the ID of the post/page/event where the tickets were created_

### Tribe Tickets RSVP Protected Content shortcode

The shortcode only shows the content if the currently logged in user is or isn't an attendee on the provided event. It supports HTML, text content, other shortcodes, oEmbeds, or any other useful content you might want.

It has three *optional parameters* available to customize how it works:

* `post_id` - This defaults to the current post ID. The ID of the event (post or page, depending on your site configuration) of which you want to check RSVP attendee status.
* `rsvp_ids` - This defaults to attendees for _any RSVP_. Provide a comma-separated list of RSVP IDs to limit the attendee status check for.
* `not_rsvp_ids` - This defaults as empty. Provide a comma-separated list of RSVP IDs to exclude on the attendee status check for. _Note: This will ensure that only attendees who have RSVP'd for other RSVP's will be returned._
* `rsvpd` - This defaults to `1` which means the shortcode will always check that the user **IS an RSVP attendee** before showing the content. Set this to `0` to check that the user **IS NOT an RSVP attendee** before showing the content.

#### Example 1: Protected content based on any RSVP attendee for the *current* event

```
[tribe_tickets_rsvp_protected_content]
This content will only show to RSVP attendees of the current event this shortcode is embedded on.
[/tribe_tickets_rsvp_protected_content]
```

#### Example 2: Protected content based on any RSVP attendee for a specific event

```
[tribe_tickets_rsvp_protected_content post_id="123"]
This content will only show to RSVP attendees of the event (ID: 123).
[/tribe_tickets_rsvp_protected_content]
```

_Where 123 is the ID of the post/page/event where the RSVP's were created_

#### Example 3: Protected content based on RSVP attendees for specific tickets on a specific event

```
[tribe_tickets_rsvp_protected_content post_id="123" rsvp_ids="32,50,90"]
This content will only show to RSVP attendees of the event (ID: 123) who have RSVP'd to certain RSVP's (IDs: 32, 50, or 90).
[/tribe_tickets_rsvp_protected_content]
```

_Where 123 is the ID of the post/page/event where the RSVP's were created_

#### Example 4: Protected content based on any RSVP NON-attendee for the *current* event

```
[tribe_tickets_rsvp_protected_content rsvpd="0"]
This content will only show to people who are NOT RSVP attendees of the current event this shortcode is embedded on.
[/tribe_tickets_rsvp_protected_content]
```

_Where 123 is the ID of the post/page/event where the RSVP's were created_

#### Example 5: Protected content based on any RSVP NON-attendee for a specific event

```
[tribe_tickets_rsvp_protected_content post_id="123" rsvpd="0"]
This content will only show to people who are NOT RSVP attendees of the event (ID: 123).
[/tribe_tickets_rsvp_protected_content]
```

_Where 123 is the ID of the post/page/event where the RSVP's were created_

#### Example 6: Protected content based on RSVP NON-attendees for specific tickets on a specific event

```
[tribe_tickets_rsvp_protected_content post_id="123" rsvp_ids="32,50,90" rsvpd="0"]
This content will only show to people who are NOT RSVP attendees of the event (ID: 123) who have NOT RSVP'd to certain RSVP's (IDs: 32, 50, or 90).
[/tribe_tickets_rsvp_protected_content]
```

_Where 123 is the ID of the post/page/event where the RSVP's were created_

#### Example 7: Protected content for RSVP attendees on a specific event who are not an attendee of specific RSVP tickets

```
[tribe_tickets_rsvp_protected_content post_id="123" not_rsvp_ids="32,50,90"]
This content will only show to people who are RSVP attendees of the event (ID: 123) who have NOT RSVP'd to certain RSVP's (IDs: 32, 50, or 90).
[/tribe_tickets_rsvp_protected_content]
```

_Where 123 is the ID of the post/page/event where the RSVP's were created_

#### Example 8: Protected content for RSVP attendees that shows up on event start date

```
[tribe_tickets_rsvp_protected_content post_id="123" on="event_start_date"]
This content will only show to people who are RSVP attendees of the event (ID: 123) on/after the event start date.
[/tribe_tickets_rsvp_protected_content]
```

_Where 123 is the ID of the post/page/event where the RSVP's were created_

#### Example 9: Protected content for RSVP attendees that shows up after a specific date

```
[tribe_tickets_rsvp_protected_content post_id="123" on="2020-05-01 08:00:00"]
This content will only show to people who are RSVP attendees of the event (ID: 123) on/after May 1st, 2020 at 8am (according to the site timezone).
[/tribe_tickets_rsvp_protected_content]
```

_Where 123 is the ID of the post/page/event where the RSVP's were created_