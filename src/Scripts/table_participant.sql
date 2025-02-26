--
-- PostgreSQL database dump
--

-- Dumped from database version 15.2
-- Dumped by pg_dump version 15.2

-- Started on 2025-02-21 13:47:50

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 214 (class 1259 OID 66446)
-- Name: tb_participant; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tb_participant (
    id "char" NOT NULL,
    email text NOT NULL,
    training_date date NOT NULL,
    p_name text NOT NULL,
    division text NOT NULL,
    facility text NOT NULL,
    phone_number text NOT NULL,
    certificate_path text NOT NULL
);


ALTER TABLE public.tb_participant OWNER TO postgres;

--
-- TOC entry 3315 (class 0 OID 66446)
-- Dependencies: 214
-- Data for Name: tb_participant; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tb_participant (id, email, training_date, p_name, division, facility, phone_number, certificate_path) FROM stdin;
\.


--
-- TOC entry 3172 (class 2606 OID 66452)
-- Name: tb_participant tb_participant_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_participant
    ADD CONSTRAINT tb_participant_pkey PRIMARY KEY (id);


-- Completed on 2025-02-21 13:47:50

--
-- PostgreSQL database dump complete
--

