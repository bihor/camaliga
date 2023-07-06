#
# Table structure for table 'tx_camaliga_domain_model_content'
#
CREATE TABLE tx_camaliga_domain_model_content (
	title varchar(255) DEFAULT '' NOT NULL,
	shortdesc text,
	longdesc text,
	link tinytext,
	slug varchar(512),
	falimage int(11) unsigned NOT NULL default '0',
	falimage2 int(11) unsigned NOT NULL default '0',
	falimage3 int(11) unsigned NOT NULL default '0',
	falimage4 int(11) unsigned NOT NULL default '0',
	falimage5 int(11) unsigned NOT NULL default '0',
	street varchar(255) DEFAULT '' NOT NULL,
	zip varchar(255) DEFAULT '' NOT NULL,
	city varchar(255) DEFAULT '' NOT NULL,
	country varchar(255) DEFAULT '' NOT NULL,
	person varchar(255) DEFAULT '' NOT NULL,
	phone varchar(255) DEFAULT '' NOT NULL,
	mobile varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	latitude decimal(14,9) DEFAULT '0.000000000',
	longitude decimal(14,9) DEFAULT '0.000000000',
	custom1 varchar(255) DEFAULT '' NOT NULL,
	custom2 varchar(255) DEFAULT '' NOT NULL,
	custom3 varchar(255) DEFAULT '' NOT NULL,
	mother int(11) DEFAULT '0' NOT NULL
);