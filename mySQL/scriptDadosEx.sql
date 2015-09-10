select * from utilizadores;

delimiter //
create procedure InserirUtilizador (nome Varchar(255), pass varchar(255), email varchar(255), contacto int(11), iniciais varchar(45), cor varchar(45))
begin
	insert into utilizadores (Nome,Password,Email,Contacto,Iniciais,Cor) 
    values (nome,pass,email,contacto,iniciais,cor);
end//

call InserirUtilizador('Vasco Fortuna','123','vascomfortuna@gmail.com',123456789,'VF','#CC0000');
call InserirUtilizador('Maria João','123','mj@mj.com',123456789,'MJ','#CC0000');

delimiter //
create procedure InserirBoleia(databoleia date, horaini time, horaf time, utilizador int(11), boleiarep int(11), repIni date, repFim date, repSem varchar(45), repDia varchar(45))
begin
	insert into boleias(data,HoraInicio,HoraFim,idUtilizador,Boleias_idBoleia,DiaSemana,RepeticaoInicio,RepeticaoFim,NSemanaRep,NDiaRep) 
    values (databoleia,horaini,horaf,utilizador,boleiarep,dayofweek(databoleia),repIni,repFim,repSem,repDia);
end//

call InserirBoleia(curdate(),curtime(),addtime(curtime(),2),1,null,curdate(),adddate(curdate(),14),'*', '0');

delimiter //
create procedure InserirBoleiaS(databoleia date, horaini time, horaf time, utilizador int(11))
begin
	insert into boleias(data,HoraInicio,HoraFim,idUtilizador,DiaSemana) 
    values (databoleia,horaini,horaf,utilizador,dayofweek(databoleia));
end//

call InserirBoleiaS(adddate(curdate(),7),curtime(),addtime(curtime(),2),1);

delimiter //
create procedure InserirEstatistica(utilizador int(11), mes date, distancia int, pcarbono int)
begin
	insert into estatisticas(idUtilizador,Mes,Distancia,PCarbono) 
    values (utilizador,mes,distancia,pcarbono);
end//

call InserirEstatistica(1,curdate(),0,0);


delimiter //
create procedure InserirConfiguracao(utilizador int(11), dataini date,  dataf date, horaini time, horaf time, horap time)
begin
	insert into configuracoes(idUtilizador,DataInicio,DataFim,HoraInicio,HoraFim,HoraPreferencial,DiaSemana) 
    values (utilizador,dataini,dataf,horaini,horaf,horap,dayofweek(dataini));
end//

call InserirConfiguracao(1,curdate(),adddate(curdate(),180),curtime(),addtime(curtime(),7),addtime(curtime(),1));

delimiter //
create procedure InserirPassgeiro(utilizador int(11), boleia int,  nota varchar(255),vu int)
begin
	insert into passageiros(Nota,ViagemUnica,idUtilizador,idBoleia) 
    values (nota,vu,utilizador,boleia);
end//

call InserirPassgeiro(1,1,'Isto é uma nota.',0);

delimiter //
create procedure InserirAlteracao(Descr varchar(255), utilizador int, boleia int,  nota varchar(255))
begin
	insert into alteracoes(Descricao,DataAlteracao,idBoleia,idUtilizador,Nota) 
    values (Descr, curdate(), boleia, utilizador, nota);
end//

call InserirAlteracao('Isto e uma descricao e uma alteracao.', 1, 1, 'Ito e uma nota do utilizador a uma alteracao');
call InserirUtilizador('teste','123','t@t.com',123456789,'t','#111111',1234,4,'t','t');
drop trigger alt_ins_bol;
delimiter //

CREATE  TRIGGER alt_ins_bol after INSERT ON boleias
for each row
begin
update utilizadores set NCondutor = NCondutor+1;
call InserirAlteracao (concat(concat('Foi criada uma boleia na hora ',NEW.horainicio,' do dia '),NEW.Data), new.idutilizador, '');
end
//
Delimiter //
CREATE TRIGGER alt_upd_bol after UPDATE ON boleias
for each row
if new.ativo=0 then
call InserirAlteracao (concat(concat('Foi eliminada uma boleia na hora ',old.horainicio,' do dia '), old.Data), old.idutilizador, '');
end if;
//

delimiter //

CREATE  TRIGGER alt_ins_pass after INSERT ON passageiros
for each row
BEgin
declare d1 date;
declare h1 time;
declare c1 varchar(255);

SET d1 := (SELECT data FROM boleias where idboleia=new.idboleia);
SET h1 := (SELECT horainicio FROM boleias where idboleia=new.idboleia);
SET c1 := (SELECT nome FROM utilizadores u join boleias b on u.idutilizador=b.idutilizador where idboleia=new.idboleia);
call InserirAlteracao (concat(concat(concat('O utilizador entrou na boleia do condutor ',c1,' da hora '),h1, ' do dia '),d1), new.idutilizador, '');
end
//

CREATE  TRIGGER alt_upd_pass after update ON passageiros
for each row
BEgin
declare d1 date;
declare h1 time;
declare c1 varchar(255);
if new.ativo=0 then
SET d1 := (SELECT data FROM boleias where idboleia=new.idboleia);
SET h1 := (SELECT horainicio FROM boleias where idboleia=new.idboleia);
SET c1 := (SELECT nome FROM utilizadores u join boleias b on u.idutilizador=b.idutilizador where idboleia=new.idboleia);
call InserirAlteracao (concat(concat(concat('O utilizador saiu da boleia do condutor ',c1,' da hora '),h1, ' do dia '),d1), new.idutilizador, '');
end if;
end
//