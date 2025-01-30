select * from tusuario where codfuncionario = '2'
-- QUERY 1
-- -----------------------------------------------------------

select
    sum(cx.valorentrada - cx.valorsaida) valorRecebido
from
    tcaixa cx
where
    cast(cx.datahoracadastro as date) between '01/23/2025' and '01/23/2025'
    and (((cx.origem = 'NOTA MANUAL') or (cx.origem = 'NOTA CONSUMIDOR') or (cx.origem = 'SANGRIA NOTA MANUAL') or (cx.origem = 'SUPRIMENTO NOTA MANUAL')))
    and cx.codcentrocusto = '1'
    and cx.codreceber is not null

-- QUERY 2
-- Total: 0
-- -----------------------------------------------------------

select
    cx.centrocusto,
    sum(cx.valorentrada - cx.valorsaida) valorentrada
from
    tcaixa cx
where
    cast(cx.datahoracadastro as date) between '01/23/2025' and '01/23/2025'
    and (((cx.origem = 'NOTA MANUAL') or (cx.origem = 'NOTA CONSUMIDOR') or (cx.origem = 'SANGRIA NOTA MANUAL') or (cx.origem = 'SUPRIMENTO NOTA MANUAL')))
    and cx.codcentrocusto = '1'
group by
    cx.centrocusto

-- QUERY 3
-- Query do centro de custo, total: 2.617,70
-- -----------------------------------------------------------

select
    sum(TOTALITENS+valordesconto) as total 

from
    titennotaconsumidor 
where
    (cancelado = 'SIM') and
    (codnotaconsumidor in(
        select
            controle
        from
            tnotaconsumidor
        where
            codfuncionario ='2' and
            ( cast(dataehoracadastro as date) between '01/23/2025' and '01/23/2025') 
            and cancelado is not null and faturada = 'SIM'))

-- QUERY 4
-- Query do total dos itens + desconto CANCELADOS, total: 0
-- Se reirar o: (cancelado = 'SIM') retorna o valor da query 5
-- -----------------------------------------------------------

select sum(TOTALITENS) as total from titennotaconsumidor where (cancelado <> 'SIM') and (codnotaconsumidor in(select controle from tnotaconsumidor where  codfuncionario ='2' and  ( cast(dataehoracadastro as date) between '01/23/2025' and '01/23/2025') and  cancelado is not null and faturada = 'SIM'))

-- QUERY 5
-- Query total de itens: 2.584,73
-- -----------------------------------------------------------

select sum(valordesconto) as descontoitem from titennotaconsumidor where (cancelado <> 'SIM') and (codnotaconsumidor in(select controle from tnotaconsumidor where  codfuncionario ='2' and  ( cast(dataehoracadastro as date) between '01/23/2025' and '01/23/2025') and  cancelado is not null and faturada = 'SIM'))

-- QUERY 6
-- Query total de desconto: 0
-- ----------------------------------------------------------

select 
    
    sum((outrosvalores * totalBruto)/100)as TTAcresc 

from
    tnotaconsumidor 

where 
    codfuncionario = '2' and
    ( cast(dataehoracadastro as date) between '01/23/2025' and '01/23/2025') and 
    tipodesconto = '%' and (cancelado <> 'SIM') and faturada = 'SIM'

-- QUERY 7
-- Query total de desconto em % e total de acrescimo: 0
-- ----------------------------------------------------------

select 
    sum(desconto)as total 

from 
    tnotaconsumidor

where
    codfuncionario ='2' and
    ( cast(dataehoracadastro as date) between '01/23/2025' and '01/23/2025') and
    tipodesconto <> '%' and (cancelado <> 'SIM') and faturada = 'SIM'

-- QUERY 8
-- Query total de desconto em $: 0
-- ----------------------------------------------------------

select
    sum(outrosvalores)as total 
    
from
    tnotaconsumidor 

where   
    codfuncionario ='2' and
    ( cast(dataehoracadastro as date) between '01/23/2025' and '01/23/2025') and  
    tipodesconto <> '%' and (cancelado <> 'SIM') and faturada = 'SIM'

-- QUERY 9
-- Query total de outros valores ( acréscimo possivelmente ): 0
-- ----------------------------------------------------------

select 
    sum(totalnota) as total
    
from
    tnotaconsumidor

where  
    codfuncionario ='2' and
    ( cast(dataehoracadastro as date) between '01/23/2025' and '01/23/2025') and
    cancelado <> 'SIM' and faturada = 'SIM'

-- QUERY 10
-- Query total das notas do funcionário 2 que não estão canceladas e estão faturadas: R$ 2.584,73
-- ----------------------------------------------------------

select sum(valorsaida) as totalsangria from tcaixa where  codfuncionario ='2' and  ( cast(datahoracadastro as date) between '01/23/2025' and '01/23/2025') and  origem = 'SANGRIA NOTA MANUAL'

-- QUERY 11
-- Query total das sangrias: R$ 2.805,23
-- ----------------------------------------------------------

select
    sum(valorsaida) as totalsangria 

from
    tcaixa 

where
    codfuncionario ='2' and  
    ( cast(datahoracadastro as date) between '01/23/2025' and '01/23/2025') and 
    origem = 'SANGRIA NOTA MANUAL'

-- QUERY 12
-- Query total das sangrias: R$ 2.805,23
-- ----------------------------------------------------------

select
    sum(valorentrada) as totalsuprimento 
    
from
    tcaixa

where
    codfuncionario ='2' and
    ( cast(datahoracadastro as date) between '01/23/2025' and '01/23/2025') and
    origem = 'SUPRIMENTO NOTA MANUAL'

-- QUERY 13
-- Query total das suprimento: R$ 445,75
-- ----------------------------------------------------------

select
    sum(valorsaida) as transferencia 
from
    tcaixa 
where
    codfuncionario ='2' and
    ( cast(datahoracadastro as date) between '01/23/2025' and '01/23/2025') and
    origem = 'TRANSFERÊNCIA NOTA MANUAL'

-- QUERY 14
-- Query total de transfêrencia: R$ 0
-- ----------------------------------------------------------

select distinct
    codespecie, 
    especie
    
from
    tformapagamentonotamanual 

where
    (codnotamanual in
    (select
        controle
    from
        tnotaconsumidor
    where
        codfuncionario ='2' and
        ( cast(dataehoracadastro as date) between '01/23/2025' and '01/23/2025') and
        cancelado <> 'SIM' ) and
        valorpago > 0)
        
    group by codespecie, especie

-- QUERY 15
-- Query espécies de pagamento usadas no funcionário indiferentes de canceladas
-- ----------------------------------------------------------

select
    count(*) as tt

from
    tnotaconsumidor

where
    codfuncionario ='2' and 
    ( cast(dataehoracadastro as date) between '01/23/2025' and '01/23/2025') and
    CANCELADO IS NOT NULL and
    faturada = 'SIM'

-- QUERY 16
-- Query total de notas faturadas e não canceladas no período : 22
-- ----------------------------------------------------------

select
    count(*) as tt 

from
    titennotaconsumidor 
    
where 
    (cancelado = 'SIM') and
    (codnotaconsumidor 
        in(select Controle from tnotaconsumidor where  codfuncionario ='2' and  ( cast(dataehoracadastro as date) between '01/23/2025' and '01/23/2025') and  cancelado is not null and faturada = 'SIM'))

-- QUERY 17
-- Query total de itens faturadas e canceladas no período : 0
-- ----------------------------------------------------------

select
    count(*) as tt 

from
    tnotaconsumidor 

where
    cancelado = 'SIM' and
    codfuncionario ='2' and
    ( cast(dataehoracadastro as date) between '01/23/2025' and '01/23/2025') and
    cancelado is not null and faturada = 'SIM'

    
-- QUERY 18
-- Query total de notas faturadas e canceladas no período : 0
-- ----------------------------------------------------------

select distinct
    SUM(VALORPAGO)AS TOTAL 

from
    tformapagamentonotamanual 

where
    (especie = 'DINHEIRO') and
    (codnotamanual in(select controle from tnotaconsumidor where  codfuncionario ='2' and  ( cast(dataehoracadastro as date) between '01/23/2025' and '01/23/2025') and  cancelado <> 'SIM' ))
    
-- QUERY 19
-- Query total de pagamento no dinheiro não cancelados: R$ 2.584,73
-- ----------------------------------------------------------

SELECT sum(COALESCE(TAXASERVICO, 0)) taxaServico FROM TNOTACONSUMIDOR TN INNER JOIN TCOMANDA TC ON TN.CODMODULO = TC.CONTROLE WHERE TC.DATAFECHAMENTO IS NOT NULL AND TN.FATURADA = 'SIM' AND TN.MODULO = 'COMANDAS'AND TC.DATAFECHAMENTO BETWEEN '01/23/2025' AND '01/23/2025'

-- QUERY 20
-- Query total de taxa de serviço do comandas do período : R$ 0
-- ----------------------------------------------------------

select 
    SUM(COALESCE(VALORPAGO,0)) TOTAL
from
    tformapagamentonotamanual 

where
    (especie = 'DINHEIRO') and
    (codnotamanual in(
        select 
            controle

        from    
            tnotaconsumidor 

        where   
            codfuncionario ='2' and
            ( cast(dataehoracadastro as date) between '01/23/2025' and '01/23/2025') and 
            cancelado <> 'SIM'))

-- QUERY 21
-- Query total da forma de pagamento em dinheiro do nota manual MEI do período : R$ 2.584,73
-- ----------------------------------------------------------

select 
    SUM(COALESCE(VALORPAGO,0)) TOTAL 
from
    tformapagamentonotamanual

where 
    (especie = 'CARTÃO CRÉDITO')
    and (codnotamanual in(select controle from tnotaconsumidor where ( cast(dataehoracadastro as date) between '01/23/2025' and '01/23/2025') and  cancelado <> 'SIM'))

-- Apenas do funcionario dois
-- and (codnotamanual in(select controle from tnotaconsumidor where  codfuncionario ='2' and  ( cast(dataehoracadastro as date) between '01/23/2025' and '01/23/2025') and  cancelado <> 'SIM'))

-- QUERY 22
-- Query total da forma de pagamento em cartão de crédito do nota manual MEI do período : R$ 0
-- ----------------------------------------------------------

select SUM(COALESCE(VALORPAGO,0)) TOTAL from tformapagamentonotamanual where (especie = 'CARTÃO DÉBITO') and (codnotamanual in(select controle from tnotaconsumidor where  codfuncionario ='2' and  ( cast(dataehoracadastro as date) between '01/23/2025' and '01/23/2025') and  cancelado <> 'SIM'))

-- QUERY 23
-- Query total da forma de pagamento em cartão de débito do nota manual MEI do período : R$ 0
-- ----------------------------------------------------------

select SUM(COALESCE(VALORPAGO,0)) TOTAL from tformapagamentonotamanual where (especie = 'CARNÊ') and (codnotamanual in(select controle from tnotaconsumidor where  codfuncionario ='2' and  ( cast(dataehoracadastro as date) between '01/23/2025' and '01/23/2025') and  cancelado <> 'SIM'))

-- QUERY 24
-- Query total da forma de pagamento em carnê do nota manual MEI do período : R$ 0
-- ----------------------------------------------------------

select SUM(COALESCE(VALORPAGO,0)) TOTAL from tformapagamentonotamanual where (especie = 'CARNÊ') and (codnotamanual in(select controle from tnotaconsumidor where  codfuncionario ='2' and  ( cast(dataehoracadastro as date) between '01/23/2025' and '01/23/2025') and  cancelado <> 'SIM'))

-- QUERY 25
-- Query total da forma de pagamento em carnê do nota manual MEI do período : R$ 0
-- ----------------------------------------------------------

select SUM(COALESCE(VALORPAGO,0)) TOTAL from tformapagamentonotamanual where (especie = 'CRÉDITO DO CLIENTE') and (codnotamanual in(select controle from tnotaconsumidor where  codfuncionario ='2' and  ( cast(dataehoracadastro as date) between '01/23/2025' and '01/23/2025') and  cancelado <> 'SIM'))

-- QUERY 26
-- Query total da forma de pagamento em crédito do cliente do nota manual MEI do período : R$ 0
-- ----------------------------------------------------------

select SUM(COALESCE(VALORPAGO,0)) TOTAL from tformapagamentonotamanual where (especie = 'CONVENIO') and (codnotamanual in(select controle from tnotaconsumidor where  codfuncionario ='2' and  ( cast(dataehoracadastro as date) between '01/23/2025' and '01/23/2025') and  cancelado <> 'SIM'))

-- QUERY 27
-- Query total da forma de pagamento em convenio do nota manual MEI do período : R$ 0
-- ----------------------------------------------------------

select SUM(COALESCE(VALORPAGO,0)) TOTAL from tformapagamentonotamanual where (especie = 'CHEQUE') and (codnotamanual in(select controle from tnotaconsumidor where  codfuncionario ='2' and  ( cast(dataehoracadastro as date) between '01/23/2025' and '01/23/2025') and  cancelado <> 'SIM'))

-- QUERY 28
-- Query total da forma de pagamento em cheque do nota manual MEI do período : R$ 0
-- ----------------------------------------------------------

select SUM(COALESCE(VALORPAGO,0)) TOTAL from tformapagamentonotamanual where (especie = 'CARTÃO') and (codnotamanual in(select controle from tnotaconsumidor where  codfuncionario ='2' and  ( cast(dataehoracadastro as date) between '01/23/2025' and '01/23/2025') and  cancelado <> 'SIM'))

-- QUERY 29
-- Query total da forma de pagamento em cartão do nota manual MEI do período : R$ 0
-- ----------------------------------------------------------

select SUM(COALESCE(VALORPAGO,0)) TOTAL from tformapagamentonotamanual where (especie = 'CARTÃO ALIMENTAÇÃO') and (codnotamanual in(select controle from tnotaconsumidor where  codfuncionario ='2' and  ( cast(dataehoracadastro as date) between '01/23/2025' and '01/23/2025') and  cancelado <> 'SIM'))

-- QUERY 30
-- Query total da forma de pagamento em cartão de alimentação do nota manual MEI do período : R$ 0
-- ----------------------------------------------------------

select SUM(COALESCE(VALORPAGO,0)) TOTAL from tformapagamentonotamanual where (especie = 'PIX') and (codnotamanual in(select controle from tnotaconsumidor where  codfuncionario ='2' and  ( cast(dataehoracadastro as date) between '01/23/2025' and '01/23/2025') and  cancelado <> 'SIM'))

-- QUERY 31
-- Query total da forma de pagamento em PIX do nota manual MEI do período : R$ 0
-- ----------------------------------------------------------

select * from tcaixa where  codfuncionario ='2' and  ( cast(datahoracadastro as date) between '01/23/2025' and '01/23/2025') and  origem = 'SANGRIA NOTA MANUAL'

-- QUERY 32
-- Query total de registros de sangria do nota manual MEI do período : 4
-- ----------------------------------------------------------

select * from tcaixa where  codfuncionario ='2' and  ( cast(datahoracadastro as date) between '01/23/2025' and '01/23/2025') and  origem = 'SUPRIMENTO NOTA MANUAL'

-- QUERY 32
-- Query total de registros de subrimento do nota manual MEI do período : 2
-- ----------------------------------------------------------