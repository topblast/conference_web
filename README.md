# conference_web
CSS Conference Application Web &amp; Server Implementation

#Database Layout

Conference database
- CID - conference ID [pk]
- Conference name
- Conference type
- Location
- Client ID
- Start Date (will include time)
- End Date (will include time)

Speakers
- Speaker ID [pk]
- Speaker Name
- Speaker affiliation
- Speaker email
- Speaker Tel Number
- Path to Image

Attendees
- Attendee ID [pk]
- Name
- Email
- Salted Password
- Array of con ID [fk] *

Clients
- Related Organisation
- Client ID [pk]
- Contact Name
- Email
- Salted Password
- Address

Categories
- Category ID [pk]
- Name
- Keyword
- Parent ID [fk]

Rooms
- Room ID [pk]
- Name
- Conference ID [fk]

Presentation
- Conference ID [fk]
- Presentation ID [pk]
- Room ID [fk]
- Title
- Abstract
- Key Words
- Array of Cat. ID [fk]

Chat Log
- Chat ID [pk]
- Conference ID [fk]
- Attendee ID [fk]
- Message
- Date Sent


Sponsors
- Spnosor ID [pk]
- Conference ID [fk]
- Name
- Description
- Path to Image
- Website Link

White List
- Conference ID [pk]
- Attendee ID
- Email
- Token
- Type {email/token}

Black List
- Conference ID [pk]
- Attendee ID

Presentation Speaker
- Speaker ID [fk]
- Presentation ID [fk]
- Speaker Type {Keynote, Discount}