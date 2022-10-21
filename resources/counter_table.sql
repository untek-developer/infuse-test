
CREATE SEQUENCE banner_count_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."banner_count" (
    "id" integer DEFAULT nextval('banner_count_id_seq') NOT NULL,
    "ip_address" character varying NOT NULL,
    "user_agent" character varying NOT NULL,
    "view_date" timestamp NOT NULL,
    "page_url" character varying NOT NULL,
    "views_count" integer NOT NULL,
    CONSTRAINT "banner_count_ip_address_user_agent_page_url" UNIQUE ("ip_address", "user_agent", "page_url")
) WITH (oids = false);
