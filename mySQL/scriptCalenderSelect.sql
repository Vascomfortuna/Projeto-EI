insert into utilizadores(nome,password,email) VALUES ('Vasco','123','vasco@hotmail.com');

insert into repeticoes(idBoleia,EventoChave,EventoValor) VALUES (1,'rep_inicio',UNIX_TIMESTAMP(CURDATE()));
insert into repeticoes(idBoleia,EventoChave,EventoValor) VALUES (1,'rep_ano_1','*');
insert into repeticoes(idBoleia,EventoChave,EventoValor) VALUES (1,'rep_mes_1','*');
insert into repeticoes(idBoleia,EventoChave,EventoValor) VALUES (1,'rep_semana_1','2');
insert into repeticoes(idBoleia,EventoChave,EventoValor) VALUES (1,'rep_diasemana_1','3');

insert into repeticoes(idBoleia,EventoChave,EventoValor) VALUES (2,'rep_inicio',UNIX_TIMESTAMP(CURDATE()));
insert into repeticoes(idBoleia,EventoChave,EventoValor) VALUES (2,'rep_ano_2','*');
insert into repeticoes(idBoleia,EventoChave,EventoValor) VALUES (2,'rep_mes_2','*');
insert into repeticoes(idBoleia,EventoChave,EventoValor) VALUES (2,'rep_semana_2','2');
insert into repeticoes(idBoleia,EventoChave,EventoValor) VALUES (2,'rep_diasemana_2','5');


select* from repeticoes;
select* from boleias;

insert into boleias(Data,HoraInicio,Duracao,idUtilizador) values ('2015-06-11','06:00:00',2,1);

SELECT EV . *
FROM boleias AS EV
JOIN repeticoes EM1 ON EM1.idBoleia = EV.idBoleia
AND EM1.EventoChave = 'rep_inicio'
LEFT JOIN repeticoes EM2 ON EM2.EventoChave = CONCAT( 'rep_ano_', EM1.idRepeticao )
LEFT JOIN repeticoes EM3 ON EM3.EventoChave = CONCAT( 'rep_mes_', EM1.idRepeticao )
LEFT JOIN repeticoes EM4 ON EM4.EventoChave = CONCAT( 'rep_semana_', EM1.idRepeticao )
LEFT JOIN repeticoes EM5 ON EM5.EventoChave = CONCAT( 'rep_diasemana_', EM1.idRepeticao )
WHERE (
  EM2.EventoValor =concat(year(curdate()))
  OR EM2.EventoValor = '*'
)
AND (
  EM3.EventoValor = concat(month(curdate()))
  OR EM3.EventoValor = '*'
)
AND (
  EM4.EventoValor ='2'
  OR EM4.EventoValor = '*'
)
AND (
  EM5.EventoValor =concat(weekday(curdate()))
  OR EM5.EventoValor = '*'
)
AND EM1.EventoValor >= UNIX_TIMESTAMP(CURDATE());

select CURDATE() from dual;

select concat(week(curdate())) from dual;

select concat(weekday('2015-06-09')) from dual;

select sum(NCondutor),sum(NPassageiro),sum(NPessoasLevadas) from estatisticas where idutilizador=1 and month(mes)=9 and year(mes)=2015;

select distinct year(mes) from estatisticas;

call InserirBoleiaS('2015-09-14','08:00:00','08:30:00',1);

delete from estatisticas;

update utilizadores set ncondutor =0, NPassageiro=0;

call InserirPassgeiro(3,185,'',0);

select b.data, b.idutilizador from boleias b join passageiros p on b.idboleia = p.idboleia where p.idboleia=184;

Select u.email from utilizadores u join passageiros p on u.idutilizador=p.idutilizador where p.idboleia=185;