-- PFPG7M.ADMINS definition

CREATE TABLE ADMINS(
  AUSER_NAME VARCHAR2(30) NOT NULL ENABLE,
	APASS VARCHAR2(30) NOT NULL ENABLE,
	CONSTRAINT ADMINS_PK PRIMARY KEY (AUSER_NAME) ENABLE
);

-- PFPG7M.ADMIN_FOR definition

CREATE TABLE ADMIN_FOR(
  UA_NAME VARCHAR2(100),
	C_NAME VARCHAR2(100),
	CONSTRAINT ADMIN_FOR_PK PRIMARY KEY (UA_NAME, C_NAME) ENABLE,
	CONSTRAINT FK_CATEGORY FOREIGN KEY (C_NAME)
	REFERENCES PFPG7M.CATEGORY (C_NAME) ENABLE,
	CONSTRAINT FK_ADMINS FOREIGN KEY (UA_NAME) REFERENCES PFPG7M.ADMINS (AUSER_NAME) ENABLE
);

-- PFPG7M.ADVISOR definition

CREATE TABLE ADVISOR(
  A_NAME VARCHAR2(80),
	T_NAME VARCHAR2(80),
	CONSTRAINT ADVISOR_PK PRIMARY KEY (A_NAME, T_NAME) ENABLE,
	CONSTRAINT FK_TEAM FOREIGN KEY (T_NAME) REFERENCES PFPG7M.TEAM (T_NAME) ENABLE
);


-- PFPG7M.CATEGORY definition

CREATE TABLE CATEGORY(
  C_NAME VARCHAR2(80),
	P_COMPLETED NUMBER(*,0),
	CONSTRAINT CATEGORY_PK PRIMARY KEY (C_NAME) ENABLE
);


-- PFPG7M.PLAYER definition

CREATE TABLE PLAYER(
  USER_NAME VARCHAR2(30) NOT NULL ENABLE,
	PASS VARCHAR2(30) NOT NULL ENABLE,
	SCORE NUMBER(*,0) DEFAULT 0,
	CONSTRAINT PLAYER_PK PRIMARY KEY (USER_NAME) ENABLE
);


-- PFPG7M.PUZZLE definition

CREATE TABLE PUZZLE(
  PUZZ_NO NUMBER(*,0) NOT NULL ENABLE,
	PUZZ_VAL NUMBER(*,0) NOT NULL ENABLE,
	PUZZ_FLAG VARCHAR2(100) NOT NULL ENABLE,
	PUZZ_NAME VARCHAR2(100) NOT NULL ENABLE,
	PUZZ_BODY VARCHAR2(100) NOT NULL ENABLE,
	CONSTRAINT FLAGS_PK PRIMARY KEY (PUZZ_NO) ENABLE
);


-- PFPG7M.PUZZLE_HINT definition

CREATE TABLE PUZZLE_HINT(
  HINT VARCHAR2(80),
	P_NUMBER NUMBER(*,0),
  CONSTRAINT PUZZLE_HINT_PK PRIMARY KEY (HINT, P_NUMBER) ENABLE,
	CONSTRAINT FK_PUZZLE FOREIGN KEY (P_NUMBER) REFERENCES PFPG7M.PUZZLE (PUZZ_NO) ENABLE
);



-- PFPG7M.P_BELONGS_TO definition

CREATE TABLE P_BELONGS_TO(
  C_NAME VARCHAR2(100),
	P_NUMBER NUMBER(*,0),
	CONSTRAINT P_BELONGS_TO_PK PRIMARY KEY (C_NAME, P_NUMBER) ENABLE,
	CONSTRAINT FK_CATEGORY2 FOREIGN KEY (C_NAME) REFERENCES PFPG7M.CATEGORY (C_NAME) ENABLE,
	CONSTRAINT FK_PUZZLE4 FOREIGN KEY (P_NUMBER) REFERENCES PFPG7M.PUZZLE (PUZZ_NO) ENABLE
);


-- PFPG7M.TEAM definition

CREATE TABLE TEAM(
  T_NAME VARCHAR2(80),
	SCORE NUMBER(*,0),
	T_RANK NUMBER(*,0),
	CONSTRAINT TEAM_PK PRIMARY KEY (T_NAME) ENABLE
);



-- PFPG7M.T_HAS_SOLVED definition

CREATE TABLE T_HAS_SOLVED(
  T_NAME VARCHAR2(100),
  P_NUMBER NUMBER(*,0),
  CONSTRAINT T_HAS_SOLVED_PK PRIMARY KEY (T_NAME, P_NUMBER) ENABLE,
  CONSTRAINT FK_TEAM3 FOREIGN KEY (T_NAME) REFERENCES PFPG7M.TEAM (T_NAME) ENABLE,
  CONSTRAINT FK_PUZZLE2 FOREIGN KEY (P_NUMBER) REFERENCES PFPG7M.PUZZLE (PUZZ_NO) ENABLE
 );

-- PFPG7M.U_BELONGS_TO definition

CREATE TABLE U_BELONGS_TO (
	UP_NAME VARCHAR2(30),
	T_NAME VARCHAR2(100),
	CONSTRAINT U_BELONGS_TO_PK PRIMARY KEY (UP_NAME,T_NAME) ENABLE,
	CONSTRAINT FK_PLAYER FOREIGN KEY (UP_NAME) REFERENCES PFPG7M.PLAYER(USER_NAME), ENABLE
	CONSTRAINT FK_TEAM2 FOREIGN KEY (T_NAME) REFERENCES PFPG7M.TEAM(T_NAME) ENABLE
);


-- PFPG7M.U_HAS_SOLVED definition

CREATE TABLE U_HAS_SOLVED (
	UP_NAME VARCHAR2(30),
	P_NUMBER NUMBER(22,0),
	CONSTRAINT U_HAS_SOLVED_PK PRIMARY KEY (UP_NAME,P_NUMBER) ENABLE,
	CONSTRAINT FK_PLAYER2 FOREIGN KEY (UP_NAME) REFERENCES PFPG7M.PLAYER(USER_NAME) ENABLE,
	CONSTRAINT FK_PUZZLE3 FOREIGN KEY (P_NUMBER) REFERENCES PFPG7M.PUZZLE(PUZZ_NO) ENABLE
);