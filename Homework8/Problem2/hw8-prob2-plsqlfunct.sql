/*========      
    function: title_total_cost: varchar2 -> number

    purpose: expects the ISBN of the title of interest, and returns
        the total cost of all of the current quantity
        of that title. (If there is no title with that ISBN,
        it returns -1, so the caller can tell that there is no
        such title.)

    note: assumes the tables in create-bks.sql have been created,
        and its tests assume initial-population script pop-bks.sql
        has been run
========*/

create or replace function title_total_cost(p_isbn varchar2) 
    return number as

    isbn_count integer;
    unit_cost  title.ttl_cost%type;
    curr_qty   title.ttl_qty%type;
    total_cost number;

begin
    -- is there a title with this ISBN? 

    select count(*)
    into isbn_count
    from title
    where ttl_isbn = p_isbn;
    
    -- if there is such a title, compute the desired total cost 

    if (isbn_count != 0) then

        select ttl_cost, ttl_qty
        into   unit_cost, curr_qty
        from   title
        where  ttl_isbn = p_isbn;

        total_cost := unit_cost * curr_qty;

    -- if there isn't such a title, let user know by returning -1

    else
        total_cost := -1;

    end if;        

    return total_cost;
end;
/
show errors
