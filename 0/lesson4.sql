select g.game
from 
	(select u.game, SUM(p.amount) amount
	from payments p join 
		(select id, game from users where level > 10) u
		on p.user_id = u.id
	group by u.game) g
where g.amount > 100