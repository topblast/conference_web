#Clients
- GET `/clients/`
> Information on all Clients
- GET `/clients/{id}/`
> Information about one Client
- POST `/clients/register`
> Sign-Up a client's account
- POST `/clients/{id}/changepassword`
> Verify and Change Password
- DELETE `/clients/{id}`
> Deletes a client's account
- PUT `/client/{id}`
> Modifies information about one client
> - Contact Name
> - Organization
> - Address (address 1 & 2, city and country) 

#Conferences
- GET `/conferences/`
> Information on all public conferences
- GET `/conferences/{id}`
> Information on a conference (public or private)
- POST `/conferences/`
> Registers for a new conference.
> - Requires Client Authentication
> - Handles Payment
> - *Research payment callback...*
- DELETE `/conferences/{id}`
> Deletes a client's Conference
- PUT `/conferences/{id}`
> Modifies information about one client
> - Name
> - Type (public / private)
> - Address (address 1 & 2, city and country) 
> - Start Time
> - End Time

##Conference Presentations
- GET `/conferences/{id}/presentations`
> All presentations within a conference
- POST `/conferences/{id}/presentations`
> Creates a new presentation
> - Requires Client Authentication

##Conference Sponsors
- GET `/conferences/{id}/sponsors/`
> Get all sponsors for conference
- POST `/conferences/{id}/sponsors/`
> Post a new sponsor for a conference
- DELETE `/conferences/{id}/sponsors/`
> Removes a sponsor from a conference

#Speakers
- GET `/speakers/`
> Information on all Speakers
- POST `/speakers/`
> Creates a new speaker

##Speaker Presentations
- GET `/speakers/{id}/presentations`
> All Presentations a speaker is affiliated with.

#Attendees
- GET `/attendees/{id}/`
> Information on an attendee
- POST `/attendees/register`
> Signing Up for an attendee account
- POST `/attendees/{id}/changepassword`
> Change an attendee's account password
- DELETE `/attendees/{id}/`
> Delete of an attendee's account
- PUT `/attendees/{id}/`
> Modifies an attendees information
> - Name
