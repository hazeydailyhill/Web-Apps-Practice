/*===========
Haley Hill
CS 328 - Homework 2 - Problems 1-3
Last Modified: 02/07/23
============*/

set serveroutput on

spool 328hw2-out.txt
prompt Haley Hill
prompt =============  Problem 1 ==============
/*===========
procedure: silly_shout: varchar2, integer -> void
purpose: expects a desired message and how many times it is to be "shouted"
	to the screen. If the number of times is less than 0, a message will
	be printed saying it cannot show the message that many times.
	Otherwise, it should print the given message in all-uppercase with
	two exclamation points at the end, the number of times given.
============*/

create or replace procedure silly_shout(message varchar2, num_shout integer) as
	counter integer;
begin
	if num_shout <= 0 then
		dbms_output.put_line('no can do');
	else
		counter := 0;
		for counter in 0 .. num_shout - 1
		loop
			dbms_output.put_line(upper(message) || '!!');
		end loop;
	end if;
end;
/
show errors

/*===== TESTING =====*/
prompt===============
prompt TESTING silly_shout: should print shouted message three times
prompt===============
exec silly_shout('hello', 3)
prompt===============
prompt TESTING silly_shout: should print 'no can do'
exec silly_shout('howdy', -1)

start silly_shout_test.sql

prompt ========== Problem 2 ============
/*===========
function: title_total_cost: integer -> float
purpose: expects a title's ISBN and returns the total cost of all of the
	current quantity for that title.
	If there is no title with that ISBN, it should return -1.
============*/

create or replace function title_total_cost(desired_isbn char)
	return number as
	cost number;
	qty number;
begin
 -- checking to see if it exists!
	select count(*)
	into qty
	from title
	where ttl_isbn = desired_isbn;

	if qty = 0 then
		return -1;

	else
		select ttl_cost
    into cost
		from title
		where ttl_isbn = desired_isbn;

		select ttl_qty
		into qty
		from title
		where ttl_isbn = desired_isbn;
	end if;

	return cost * qty;
end;
/
show errors
set serveroutput on

/*===== TESTING =====*/
prompt===============
prompt TESTING title_total_cost: should print 15 * 30.75 (461.25)
prompt===============
var ttc number;
exec :ttc := title_total_cost('9780201122305')
print ttc

prompt===============
prompt TESTING title_total_cost: should print 5 * 26.50 (132.5)
prompt===============
var ttc number;
exec :ttc := title_total_cost('9780805343021')
print ttc

start title_total_cost_test.sql

prompt ========== Problem 3a ============
drop table salary_history cascade constraints;

create table salary_history
(empl_num char(4),
prev_salary number(6, 2),
next_salary number(6, 2),
change_date date,
primary key (empl_num, change_date),
foreign key (empl_num) references empl);

prompt ========= Problem 3b ==========
prompt
create or replace trigger log_salary_updates
	after update
	on empl
	for each row

begin
	dbms_output.put_line('About the update the salary row');
	if :old.salary != :new.salary then
		insert into salary_history
		values
		(:new.empl_num, :old.salary, :new.salary, sysdate);
	end if;
end;
/
show errors
set serveroutput on
commit;

/*===== TESTING =====*/
prompt===============
prompt TESTING log_salary_updates
prompt===============
update empl
set salary = '300'
where empl_num = '7839';

update empl
set salary = '200'
where empl_num = '7566';

select *
from empl;

select *
from salary_history;

rollback;


spool off
