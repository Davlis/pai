create or replace function generate_ssid(size integer) returns text as $$
declare 
  gen_ssid text;
  done bool;
begin 
  done := false;
    while not done loop
        select string_agg (substr('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', ceil (random() * 62)::integer, 1), '') into gen_ssid from generate_series(1, size);
        done := not exists(select ssid from usersessions where ssid=gen_ssid);
    end loop;
    return gen_ssid;
end;
$$ language PLPGSQL volatile;

create table countries (
  id serial primary key not null unique,
  countryname text not null unique
);

create table cities(
  id serial primary key not null unique,
  cityname text not null,
  countryid integer not null references countries(id)
);

create table postcodes(
  id serial primary key not null unique,
  postcode integer not null
);

create table addresses(
  id serial primary key not null unique,
  cityid integer not null references cities(id),
  street text not null,
  postcodeid integer references postcodes(id)
);

create table shopnames(
  id serial not null primary key unique,
  shopname text not null
);

create table malls(
  id serial not null primary key unique,
  mallname text not null,
  addressid integer not null references addresses(id)
);

create table shops(
  id serial not null primary key unique,
  shopnameid integer not null references shopnames(id),
  addressid integer references addresses(id),
  mallid integer references malls(id)
);

create table userprivileges(
  id serial not null primary key unique,
  privilegename text not null
);

create table users(
  id serial not null primary key unique,
  email text not null,
  pass text not null,
  privilegeid integer not null references userprivileges(id),
  namefield text not null default 'User',
  active bool not null default false,
  activationcode text not null default generate_ssid(16)
);

create table userlogs(
  id serial not null primary key unique,
  timepoint timestamp not null,
  userid integer not null references users(id),
  ip text not null
);

create table usersessions(
  id serial not null primary key unique,
  ssid text not null unique default generate_ssid(32),
  userid integer not null references users(id)
);

create table receipts(
  id serial not null primary key unique,
  userid integer not null references users(id),
  datestamp date,
  shopid integer not null references shops(id),
  sum float not null
);

create table productnames(
  id serial not null primary key unique,
  productname text not null
);

create table products(
  id serial not null primary key unique,
  productnameid integer not null references productnames(id),
  receiptid integer not null references receipts(id),
  quantity integer not null,
  price float not null
);

create or replace function update_sum() returns trigger as $$
begin


end;
$$ language PLPGSQL volatile;



CREATE OR REPLACE FUNCTION rec_insert()
  RETURNS trigger AS
$$
BEGIN
         INSERT INTO emp_log(emp_id,salary,edittime)
         VALUES(NEW.employee_id,NEW.salary,current_date);
 
    RETURN NEW;
END;
$$
LANGUAGE 'plpgsql';

create trigger update_sum_trigger
  after insert or delete or update 
  on products
  for each row
  execute procedure update_sum();


insert into userprivileges (privilegename) values ('Admin');
insert into userprivileges (privilegename) values ('User');
insert into users (email, pass, privilegeid) values ('admin@localhost', 'admin', 0);
   


