#booking room
Function:

	+ user
	+ room
	+ booking [
		date:
		users: [1,2,3,4]
		room:
		createBy: user1
	]
	+ user invite "X" > booking1
	+ X accept the request > booking1
	+ user create booking1

Miscellaneous:

##polling
	+ user createBooking CHANGE the date!!!
	>polling, NEED poling to change

	+ user createBooking, but other ASK for change date
	>polling
	polling[
		{date, users[1,2,3,4,5]},
		{date, users[1,2]},
		{date, users[1,2,3]},
		{date, users[2,3]},
		endPollAt: 28/9
		irresponseUser: acceptBookDate
	]
	>polling RULE
	>decide how get infor from polling

	>polling just simple RECORD[
		{date, users[]},
		{date, users[]},
		{date, users[]},
		{date, users[]},
		{date, users[]},
		{date, users[]},
		{date, users[]},
		{date, users[]},
		{date, users[]},
	]
	>loop, check WHO NOT (irresponse)
	>PUSH them in bookDate by user1
	>polling[
		{date, users[]},
		...,
		{bookDate, users[... + irresponse]}
	]

	group, when send out to many
	group [1,2,3,4,5]

	HOW TO SEARCH user???
	WHAT INFO from user is available

##group
	group > user
	ALLOW by default search by group
	JOIN into an GROUP, need accept by ADMIN of group

	group [1,2,3,4,5]
	admin: [2,3,4]
	they can invite other people to JOIN IN

	ONLY search people in GROUP
	GROUP created by userX

	DONE

	D3, DC, CROSSFILTER allow to draw 
	BY MONTH
	BY WEEK

	select group by color box [_][_][_][_]
	only show SELECTED group

##notification
	how to we let a BOOKING sent to user
	if they ONLINE, send out
	MAY I SEND OUT BY GOOGLE-notification
	.....
	but i HAVE TO SENT IT OUT
	if they OFFLINE, email them
	done

	user > email > channel (slack) > to NOTIFY when thing go wrong
	>EVENT > LISTENER

	version control
	booking CHANGED == created a new booking
	we work on booking

	but EXIST system, check what booking is belongs to
	[bookingX, bookingY, bookingZ] > belongs to [event X]
	how i can trigger OUT event X

##booking history
	userA, go to booking1
	click on HISTORY
	ask BookingHistory for where booking1 IN
	event id|hashcode|bookingID
	from bookingID 1 > get out hashcode
	from eventID > get ALL has the same hashcode

	each booking HAS a hashcode

	we polling to create a NEW booking HAS SAME HASCODE

	just query on THAT DATABASE

##room
	name, location, description
	location toa nha X, 110A quoc huong, lau 3

	name, address, detail, description
	address > string > google search
	detail > come in & find out

##officeX
	filter for room
	id|officeX|roomId
	id|officeX|roomId
----------------
#TASK
+ ~~Insert rooms from xls file~~
+ ~~booking > create~~
+ ~~booking > index~~
+ ~~group > create~~
+ ~~group > index~~
+ ~~invite > load USER from groups~~
+ ~~booking/X > detail~~
+ fix bug booking/x/invite, where not exist
+ we need group/X > detail
+ check basic-function work SMOOTH
+ check basic-function work EASY to USE
+ check UI look simple
+ check userA create group1 > group_user has 1,A (quite dangerous!!!)
+ check userA create booking1 > booking_user has 1,A (too dangerous!!!)
WHAT HAPPEN, when we CLEAR booking1 from userA, WHAT MAKE SURE THAT booking_user updated too???