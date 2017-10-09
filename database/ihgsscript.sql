--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.5
-- Dumped by pg_dump version 9.6.5

-- Started on 2017-10-09 09:10:21

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

DROP DATABASE ihgs;
--
-- TOC entry 2217 (class 1262 OID 16410)
-- Name: ihgs; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE ihgs WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'English_United States.1252' LC_CTYPE = 'English_United States.1252';


ALTER DATABASE ihgs OWNER TO postgres;

\connect ihgs

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 12387)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2220 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 186 (class 1259 OID 16419)
-- Name: m_belong; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE m_belong (
    belong_id integer NOT NULL,
    belong_name text,
    belong_parent_id integer,
    belong_sort integer,
    belong_free1 text,
    belong_free2 text,
    belong_free3 text,
    belong_free4 text,
    belong_free5 text,
    last_date timestamp with time zone,
    last_kind smallint,
    last_ipadrs text,
    last_user integer,
    belong_code text
);


ALTER TABLE m_belong OWNER TO postgres;

--
-- TOC entry 2221 (class 0 OID 0)
-- Dependencies: 186
-- Name: TABLE m_belong; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE m_belong IS 'The belong relation are parent (division) and child(section)';


--
-- TOC entry 200 (class 1259 OID 16498)
-- Name: m_belong_belong_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE m_belong_belong_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE m_belong_belong_id_seq OWNER TO postgres;

--
-- TOC entry 2222 (class 0 OID 0)
-- Dependencies: 200
-- Name: m_belong_belong_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE m_belong_belong_id_seq OWNED BY m_belong.belong_id;


--
-- TOC entry 189 (class 1259 OID 16437)
-- Name: m_doorcard; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE m_doorcard (
    md_id integer NOT NULL,
    md_card_no_row smallint,
    md_door_row smallint,
    md_door_format text,
    md_touchtime_row smallint,
    md_touchtime_format smallint,
    md_free1 text,
    md_free2 text,
    md_free3 text,
    md_free4 text,
    md_free5 text,
    last_date timestamp with time zone,
    last_kind smallint,
    last_ipadrs text,
    last_user integer
);


ALTER TABLE m_doorcard OWNER TO postgres;

--
-- TOC entry 2223 (class 0 OID 0)
-- Dependencies: 189
-- Name: TABLE m_doorcard; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE m_doorcard IS 'This table has a format of DOORCARD what uploaded file.
This table has only 01 record , and always will be Update';


--
-- TOC entry 188 (class 1259 OID 16435)
-- Name: m_doorcard_md_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE m_doorcard_md_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE m_doorcard_md_id_seq OWNER TO postgres;

--
-- TOC entry 2224 (class 0 OID 0)
-- Dependencies: 188
-- Name: m_doorcard_md_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE m_doorcard_md_id_seq OWNED BY m_doorcard.md_id;


--
-- TOC entry 191 (class 1259 OID 16448)
-- Name: m_pc; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE m_pc (
    mp_id integer NOT NULL,
    mp_pc_no_row smallint,
    mp_action_row smallint,
    mp_action_format1 text,
    mp_action_format2 text,
    mp_actiontime_row smallint,
    mp_actiontime_format smallint,
    mp_free1 text,
    mp_free2 text,
    mp_free3 text,
    mp_free4 text,
    mp_free5 text,
    last_date timestamp with time zone,
    last_kind smallint,
    last_ipadrs text,
    last_user integer
);


ALTER TABLE m_pc OWNER TO postgres;

--
-- TOC entry 2225 (class 0 OID 0)
-- Dependencies: 191
-- Name: TABLE m_pc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE m_pc IS 'This table has only 01 record, and always will be UPDATE';


--
-- TOC entry 190 (class 1259 OID 16446)
-- Name: m_pc_mp_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE m_pc_mp_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE m_pc_mp_id_seq OWNER TO postgres;

--
-- TOC entry 2226 (class 0 OID 0)
-- Dependencies: 190
-- Name: m_pc_mp_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE m_pc_mp_id_seq OWNED BY m_pc.mp_id;


--
-- TOC entry 187 (class 1259 OID 16427)
-- Name: m_timecard; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE m_timecard (
    mt_id integer NOT NULL,
    mt_staff_id_row smallint,
    m_date_row smallint,
    mt_date_format smallint,
    mt_gotime_row smallint,
    mt_gotime_format smallint,
    mt_backtime_row smallint,
    mt_backtime_format smallint,
    mt_free1 text,
    mt_free2 text,
    mt_free3 text,
    mt_free4 text,
    mt_free5 text,
    last_date timestamp with time zone,
    last_kind smallint,
    last_ipadrs text,
    last_user integer
);


ALTER TABLE m_timecard OWNER TO postgres;

--
-- TOC entry 2227 (class 0 OID 0)
-- Dependencies: 187
-- Name: TABLE m_timecard; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE m_timecard IS 'This table have a format of  TIMECARD what uploaded file.
This table has only 01 record, and always will be UPDATE';


--
-- TOC entry 201 (class 1259 OID 16500)
-- Name: m_timecard_mt_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE m_timecard_mt_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE m_timecard_mt_id_seq OWNER TO postgres;

--
-- TOC entry 2228 (class 0 OID 0)
-- Dependencies: 201
-- Name: m_timecard_mt_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE m_timecard_mt_id_seq OWNED BY m_timecard.mt_id;


--
-- TOC entry 185 (class 1259 OID 16411)
-- Name: m_user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE m_user (
    u_id integer NOT NULL,
    u_name text,
    u_login text,
    u_passwd text,
    u_belong integer,
    u_power01 smallint,
    u_power02 smallint,
    u_power03 smallint,
    u_power04 smallint,
    u_power05 smallint,
    u_power06 smallint,
    u_power07 smallint,
    u_free1 text,
    u_free2 text,
    u_free3 text,
    u_free4 text,
    u_free5 text,
    last_date timestamp with time zone,
    last_kind smallint,
    last_ipadrs text,
    last_user integer,
    remember_token text
);


ALTER TABLE m_user OWNER TO postgres;

--
-- TOC entry 2229 (class 0 OID 0)
-- Dependencies: 185
-- Name: TABLE m_user; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE m_user IS 'The user master for login';


--
-- TOC entry 202 (class 1259 OID 16502)
-- Name: m_user_u_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE m_user_u_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE m_user_u_id_seq OWNER TO postgres;

--
-- TOC entry 2230 (class 0 OID 0)
-- Dependencies: 202
-- Name: m_user_u_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE m_user_u_id_seq OWNED BY m_user.u_id;


--
-- TOC entry 195 (class 1259 OID 16466)
-- Name: t_doorcard; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE t_doorcard (
    td_id integer NOT NULL,
    td_card text,
    td_door text,
    td_touchtime timestamp with time zone,
    td_dataname text,
    td_free1 text,
    td_free2 text,
    td_free3 text,
    td_free4 text,
    td_free5 text,
    last_date timestamp with time zone,
    last_ipadrs text,
    last_user integer
);


ALTER TABLE t_doorcard OWNER TO postgres;

--
-- TOC entry 2231 (class 0 OID 0)
-- Dependencies: 195
-- Name: TABLE t_doorcard; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE t_doorcard IS 'This table INSERT by CSV file according to the format of DOORCARD as m_dorrcard';


--
-- TOC entry 194 (class 1259 OID 16464)
-- Name: t_doorcard_td_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE t_doorcard_td_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_doorcard_td_id_seq OWNER TO postgres;

--
-- TOC entry 2232 (class 0 OID 0)
-- Dependencies: 194
-- Name: t_doorcard_td_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE t_doorcard_td_id_seq OWNED BY t_doorcard.td_id;


--
-- TOC entry 197 (class 1259 OID 16478)
-- Name: t_pc; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE t_pc (
    tp_id integer NOT NULL,
    tp_pc_no text,
    tp_action text,
    tp_actiontime timestamp with time zone,
    tp_free1 text,
    tp_free2 text,
    tp_free3 text,
    tp_free4 text,
    tp_free5 text,
    last_date timestamp with time zone,
    last_ipadrs text,
    last_user integer
);


ALTER TABLE t_pc OWNER TO postgres;

--
-- TOC entry 2233 (class 0 OID 0)
-- Dependencies: 197
-- Name: TABLE t_pc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE t_pc IS 'This table is insert by CSV file according to the format of PC as m_pc';


--
-- TOC entry 196 (class 1259 OID 16476)
-- Name: t_pc_tp_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE t_pc_tp_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_pc_tp_id_seq OWNER TO postgres;

--
-- TOC entry 2234 (class 0 OID 0)
-- Dependencies: 196
-- Name: t_pc_tp_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE t_pc_tp_id_seq OWNED BY t_pc.tp_id;


--
-- TOC entry 199 (class 1259 OID 16489)
-- Name: t_staff; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE t_staff (
    staff_id integer NOT NULL,
    staff_id_no text,
    staff_name text,
    staff_belong integer,
    staff_card1 text,
    staff_card2 text,
    staff_card3 text,
    staff_card4 text,
    staff_card5 text,
    staff_card6 text,
    staff_card7 text,
    staff_card8 text,
    staff_card9 text,
    staff_card10 text,
    staff_pc1 text,
    staff_pc2 text,
    staff_pc3 text,
    staff_pc4 text,
    staff_pc5 text,
    staff_pc6 text,
    staff_pc7 text,
    staff_pc8 text,
    staff_pc9 text,
    staff_pc10 text,
    staff_free1 text,
    staff_free2 text,
    staff_free3 text,
    staff_free4 text,
    staff_free5 text,
    last_date timestamp with time zone,
    last_kind smallint,
    last_ipadrs text,
    last_user integer
);


ALTER TABLE t_staff OWNER TO postgres;

--
-- TOC entry 2235 (class 0 OID 0)
-- Dependencies: 199
-- Name: TABLE t_staff; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE t_staff IS 'This table has STAFF information. A staff is replated by staff_id_no,belong_to';


--
-- TOC entry 198 (class 1259 OID 16487)
-- Name: t_staff_staff_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE t_staff_staff_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_staff_staff_id_seq OWNER TO postgres;

--
-- TOC entry 2236 (class 0 OID 0)
-- Dependencies: 198
-- Name: t_staff_staff_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE t_staff_staff_id_seq OWNED BY t_staff.staff_id;


--
-- TOC entry 193 (class 1259 OID 16457)
-- Name: t_timecard; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE t_timecard (
    tt_id integer NOT NULL,
    tt_staff_id_no text,
    tt_date timestamp with time zone,
    tt_gotime time with time zone,
    tt_backtime time with time zone,
    tt_dataname text,
    tt_free1 text,
    tt_free2 text,
    tt_free3 text,
    tt_free4 text,
    tt_free5 text,
    last_date timestamp with time zone,
    last_ipadrs text,
    last_user integer
);


ALTER TABLE t_timecard OWNER TO postgres;

--
-- TOC entry 2237 (class 0 OID 0)
-- Dependencies: 193
-- Name: TABLE t_timecard; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE t_timecard IS 'This table INSERT by CSV file according to the format of TIMECARD as m_timecard';


--
-- TOC entry 192 (class 1259 OID 16455)
-- Name: t_timecard_tt_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE t_timecard_tt_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_timecard_tt_id_seq OWNER TO postgres;

--
-- TOC entry 2238 (class 0 OID 0)
-- Dependencies: 192
-- Name: t_timecard_tt_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE t_timecard_tt_id_seq OWNED BY t_timecard.tt_id;


--
-- TOC entry 2058 (class 2604 OID 16440)
-- Name: m_doorcard md_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY m_doorcard ALTER COLUMN md_id SET DEFAULT nextval('m_doorcard_md_id_seq'::regclass);


--
-- TOC entry 2059 (class 2604 OID 16451)
-- Name: m_pc mp_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY m_pc ALTER COLUMN mp_id SET DEFAULT nextval('m_pc_mp_id_seq'::regclass);


--
-- TOC entry 2061 (class 2604 OID 16469)
-- Name: t_doorcard td_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY t_doorcard ALTER COLUMN td_id SET DEFAULT nextval('t_doorcard_td_id_seq'::regclass);


--
-- TOC entry 2062 (class 2604 OID 16481)
-- Name: t_pc tp_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY t_pc ALTER COLUMN tp_id SET DEFAULT nextval('t_pc_tp_id_seq'::regclass);


--
-- TOC entry 2063 (class 2604 OID 16492)
-- Name: t_staff staff_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY t_staff ALTER COLUMN staff_id SET DEFAULT nextval('t_staff_staff_id_seq'::regclass);


--
-- TOC entry 2060 (class 2604 OID 16460)
-- Name: t_timecard tt_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY t_timecard ALTER COLUMN tt_id SET DEFAULT nextval('t_timecard_tt_id_seq'::regclass);


--
-- TOC entry 2196 (class 0 OID 16419)
-- Dependencies: 186
-- Data for Name: m_belong; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2239 (class 0 OID 0)
-- Dependencies: 200
-- Name: m_belong_belong_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('m_belong_belong_id_seq', 1, false);


--
-- TOC entry 2199 (class 0 OID 16437)
-- Dependencies: 189
-- Data for Name: m_doorcard; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2240 (class 0 OID 0)
-- Dependencies: 188
-- Name: m_doorcard_md_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('m_doorcard_md_id_seq', 1, false);


--
-- TOC entry 2201 (class 0 OID 16448)
-- Dependencies: 191
-- Data for Name: m_pc; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2241 (class 0 OID 0)
-- Dependencies: 190
-- Name: m_pc_mp_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('m_pc_mp_id_seq', 1, false);


--
-- TOC entry 2197 (class 0 OID 16427)
-- Dependencies: 187
-- Data for Name: m_timecard; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2242 (class 0 OID 0)
-- Dependencies: 201
-- Name: m_timecard_mt_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('m_timecard_mt_id_seq', 1, false);


--
-- TOC entry 2195 (class 0 OID 16411)
-- Dependencies: 185
-- Data for Name: m_user; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO m_user (u_id, u_name, u_login, u_passwd, u_belong, u_power01, u_power02, u_power03, u_power04, u_power05, u_power06, u_power07, u_free1, u_free2, u_free3, u_free4, u_free5, last_date, last_kind, last_ipadrs, last_user, remember_token) VALUES (1, 'Admin', 'admin', '$2y$10$3BaphrHrBNBz/biJzj1nieGSt0B1HkcF7sbtCMFQchl95UtJt.dUW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '127.0.0.1', NULL, NULL);


--
-- TOC entry 2243 (class 0 OID 0)
-- Dependencies: 202
-- Name: m_user_u_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('m_user_u_id_seq', 1, false);


--
-- TOC entry 2205 (class 0 OID 16466)
-- Dependencies: 195
-- Data for Name: t_doorcard; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2244 (class 0 OID 0)
-- Dependencies: 194
-- Name: t_doorcard_td_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('t_doorcard_td_id_seq', 1, false);


--
-- TOC entry 2207 (class 0 OID 16478)
-- Dependencies: 197
-- Data for Name: t_pc; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2245 (class 0 OID 0)
-- Dependencies: 196
-- Name: t_pc_tp_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('t_pc_tp_id_seq', 1, false);


--
-- TOC entry 2209 (class 0 OID 16489)
-- Dependencies: 199
-- Data for Name: t_staff; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2246 (class 0 OID 0)
-- Dependencies: 198
-- Name: t_staff_staff_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('t_staff_staff_id_seq', 1, false);


--
-- TOC entry 2203 (class 0 OID 16457)
-- Dependencies: 193
-- Data for Name: t_timecard; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2247 (class 0 OID 0)
-- Dependencies: 192
-- Name: t_timecard_tt_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('t_timecard_tt_id_seq', 1, false);


--
-- TOC entry 2067 (class 2606 OID 16426)
-- Name: m_belong m_belong_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY m_belong
    ADD CONSTRAINT m_belong_pkey PRIMARY KEY (belong_id);


--
-- TOC entry 2071 (class 2606 OID 16445)
-- Name: m_doorcard m_doorcard_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY m_doorcard
    ADD CONSTRAINT m_doorcard_pkey PRIMARY KEY (md_id);


--
-- TOC entry 2069 (class 2606 OID 16434)
-- Name: m_timecard m_timecard_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY m_timecard
    ADD CONSTRAINT m_timecard_pkey PRIMARY KEY (mt_id);


--
-- TOC entry 2065 (class 2606 OID 16418)
-- Name: m_user m_user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY m_user
    ADD CONSTRAINT m_user_pkey PRIMARY KEY (u_id);


--
-- TOC entry 2073 (class 2606 OID 16474)
-- Name: t_doorcard t_doorcard_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY t_doorcard
    ADD CONSTRAINT t_doorcard_pkey PRIMARY KEY (td_id);


--
-- TOC entry 2075 (class 2606 OID 16486)
-- Name: t_pc t_pc_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY t_pc
    ADD CONSTRAINT t_pc_pkey PRIMARY KEY (tp_id);


--
-- TOC entry 2077 (class 2606 OID 16497)
-- Name: t_staff t_staff_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY t_staff
    ADD CONSTRAINT t_staff_pkey PRIMARY KEY (staff_id);


--
-- TOC entry 2219 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2017-10-09 09:10:22

--
-- PostgreSQL database dump complete
--

