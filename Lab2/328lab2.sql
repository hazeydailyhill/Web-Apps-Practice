--Script Name: lab2.sql
--Names: Bryan Portillo and Haley Hill

prompt Names: Bryan Portillo and Haley Hill

/* Total Salary: job_title -> void
	prints " " || sum total of all salaries
	of empl with job_title
*/

spool lab2-out.txt
--Problem 1
create or replace procedure total_salary (job_title1 varchar2) as
	salary_sum number;

begin
	select sum(salary)
	into salary_sum 
	from empl
	where job_title = job_title1;

	dbms_output.put_line('Salary Sum: ' || salary_sum);

end;
/
show errors

--Testing procedure total_salary

set serveroutput on 

exec total_salary('Manager')
exec total_salary('Analyst')

--Problem 2

/* stored function: num_pd_more: number -> number
	purpose: exprects lower limit for salary and returns number of employs
	with salary greater than the lower limit */

create or replace function num_pd_more(lower_sal_lim number)
	return number as 
	num_emps number;
	
begin 
	select count(*)
	into num_emps
	from empl 
	where salary > lower_sal_lim;

	return num_emps;
end;
/
show errors

--set serveroutput on
prompt '1) Testing num_pd_more: '
var num_p number;
exec :num_p := num_pd_more(1000) 
print num_p

prompt '2) Testing num_pd_more: '
var num_p number;
exec :num_p := num_pd_more(300)
print num_p

--Problem 3

drop table dept_changes;

create table dept_changes
(change_date	date,
 prev_dept_name	varchar2(15),
 next_dept_name varchar2(15),
 primary key 	(change_date, prev_dept_name, next_dept_name));
 
create or replace trigger log_dept_update 
	after update
	on dept
	for each row

begin 
	dbms_output.put_line('About to update a dept row');

	insert into dept_changes 
	values
	(sysdate, :old.dept_name, :new.dept_name); 

end;
/
show errors
commit;

update dept 
set dept_name = 'First New Name'

update dept
set dept_name = 'Second New Name';

select * 
from dept;

select * 
from dept_changes;

rollback;

Spool off
