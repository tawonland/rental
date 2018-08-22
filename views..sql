
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=carexidc@localhost SQL SECURITY DEFINER VIEW 
v_rsite_rekap 
AS 
select a.id1, a.siteid, a.sitename, a.city, a.towerheight, a.sitestatus, b.leasestart, b.leaseend,
a.sitecontractperiod, 
YEAR(b.leaseend) - YEAR(b.leasestart) - (DATE_FORMAT(b.leaseend, '%m%d') < DATE_FORMAT(b.leasestart, '%m%d')) as durasi,
YEAR(b.leaseend) - YEAR(now()) as sisasewa
max((to_days(b.leaseend) - to_days(curdate()))) AS akanberakhir,
from rsite a 
left join rsite_sewa b on b.id_rsite = a.id1
left join rsite_penyewa c on b.id1 = c.id_rsite 
group by a.id1, a.siteid, a.sitename, a.city, a.towerheight, a.sitecontractperiod 
having ((to_days(b.leaseend) - to_days(curdate())) <= 120)
