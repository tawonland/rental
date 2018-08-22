<?php

//
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=carexidc@localhost SQL SECURITY DEFINER VIEW 
v_site_akanhabis 
AS 
select a.id1, a.siteid, a.sitename, a.address, a.city, a.province, a.sitecontractperiod,
max((to_days(b.leaseend) - to_days(curdate()))) AS akanberakhir,
b.leaseend AS leaseend 
from (rsite a left join rsite_sewa b on((b.id_rsite = a.id1))) 
group by a.id1,a.siteid,a.sitename,a.address,
a.city,a.province,
a.sitecontractperiod 
having ((to_days(b.leaseend) - to_days(curdate())) <= 120)
