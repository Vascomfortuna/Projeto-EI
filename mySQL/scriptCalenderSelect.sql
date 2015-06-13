insert into utilizadores(nome,password,email) VALUES ('Vasco','123','vasco@hotmail.com');

insert into repeticoes(idBoleia,EventoMeta,EventoValor) VALUES (1,'rep_inicio',UNIX_TIMESTAMP(CURDATE()));
insert into repeticoes(idBoleia,EventoMeta,EventoValor) VALUES (1,'rep_ano_1','*');
insert into repeticoes(idBoleia,EventoMeta,EventoValor) VALUES (1,'rep_mes_1','*');
insert into repeticoes(idBoleia,EventoMeta,EventoValor) VALUES (1,'rep_semana_1','2');
insert into repeticoes(idBoleia,EventoMeta,EventoValor) VALUES (1,'rep_diasemana_1','3');

select* from repeticoes;

insert into boleias(Data,HoraInicio,Duracao,idUtilizador) values ('2015-06-01','06:00:00',2,1);

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
  EM5.EventoValor ='3'
  OR EM5.EventoValor = '*'
)
AND EM1.EventoValor >= UNIX_TIMESTAMP(CURDATE());

select UNIX_TIMESTAMP(CURDATE()) from dual;