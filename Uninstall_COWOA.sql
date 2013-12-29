SELECT @t4:=configuration_group_id
FROM configuration_group
WHERE configuration_group_title= 'COWOA';
DELETE FROM configuration WHERE configuration_group_id = @t4;
DELETE FROM configuration_group WHERE configuration_group_id = @t4;
DELETE FROM admin_pages WHERE page_key = 'configCOWOA' LIMIT 1;

DELETE FROM query_builder WHERE query_builder.query_name = 'Permanent Account Holders Only' LIMIT 1;

/* Un-comment the following lines by removing the "#" fron the beginning of the line if you will not be replacing COWOA with another checkout module like FEC or FEAC */
#ALTER TABLE customers DROP COWOA_account;
#ALTER TABLE orders DROP COWOA_order;